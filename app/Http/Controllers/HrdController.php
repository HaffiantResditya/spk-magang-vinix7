<?php

namespace App\Http\Controllers;

use App\Models\ApplicantAnswer;
use App\Models\Application;
use App\Models\Criterion;
use App\Models\Division;
use App\Models\SawResult;
use App\Models\User;
use App\Services\SawCalculationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HrdController extends Controller
{
    /**
     * Display HRD analytical dashboard.
     */
    public function dashboard(): View
    {
        $totalApplicants = User::where('role', 'applicant')->count();
        $totalSubmitted = Application::count();
        $totalApproved = Application::whereIn('status', ['approved', 'reassigned'])->count();
        $totalRejected = Application::where('status', 'rejected')->count();
        $totalPending = Application::where('status', 'pending')->count();

        // Student vs General counts
        $mahasiswaCount = User::where('role', 'applicant')
            ->whereHas('profile', function ($q) {
                $q->where('type', 'mahasiswa');
            })->count();
        $umumCount = User::where('role', 'applicant')
            ->whereHas('profile', function ($q) {
                $q->where('type', 'umum');
            })->count();

        // Top recommended divisions from SAW rank 1
        $topDivisions = SawResult::where('rank', 1)
            ->selectRaw('division_id, count(*) as count')
            ->groupBy('division_id')
            ->orderByDesc('count')
            ->with('division')
            ->take(5)
            ->get();

        // Recent applications
        $recentApplications = Application::with(['user.profile', 'selectedDivision', 'approvedDivision'])
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard.hrd.index', compact(
            'totalApplicants',
            'totalSubmitted',
            'totalApproved',
            'totalRejected',
            'totalPending',
            'mahasiswaCount',
            'umumCount',
            'topDivisions',
            'recentApplications'
        ));
    }

    /**
     * List all applicants with search and status filter.
     */
    public function applicants(Request $request): View
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = User::where('role', 'applicant')
            ->with(['profile', 'application.selectedDivision', 'application.approvedDivision', 'sawResults' => function ($q) {
                $q->where('rank', '<=', 3)->with('division');
            }]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status) {
            if ($status === 'unsubmitted') {
                $query->doesntHave('application');
            } else {
                $query->whereHas('application', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            }
        }

        $applicants = $query->latest()->paginate(10)->withQueryString();

        return view('dashboard.hrd.applicants', compact('applicants', 'status', 'search'));
    }

    /**
     * Show applicant detail with questionnaire answers and SAW matrix computation.
     */
    public function applicantDetail(User $applicant, SawCalculationService $sawService): View
    {
        abort_if(!$applicant->isApplicant(), 404);

        $applicant->load(['profile', 'application.selectedDivision', 'application.approvedDivision']);

        // Fetch raw answers grouped by criterion
        $criteria = Criterion::with(['questions.answers' => function ($q) use ($applicant) {
            $q->where('user_id', $applicant->id);
        }])->get();

        // Recalculate or retrieve SAW rankings
        $sawData = $sawService->calculate($applicant);
        $divisions = Division::all();

        return view('dashboard.hrd.applicant-detail', compact(
            'applicant',
            'criteria',
            'sawData',
            'divisions'
        ));
    }

    /**
     * Process HRD decision: approve, reassign, or reject.
     */
    public function updateStatus(Request $request, Application $application): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:approved,reassigned,rejected,pending',
            'approved_division_id' => 'nullable|exists:divisions,id',
            'hrd_notes' => 'nullable|string|max:1000',
        ]);

        $approvedDivisionId = $application->selected_division_id;

        if ($request->status === 'reassigned') {
            $request->validate([
                'approved_division_id' => 'required|exists:divisions,id',
            ]);
            $approvedDivisionId = $request->approved_division_id;
        } elseif ($request->status === 'approved') {
            $approvedDivisionId = $request->approved_division_id ?: $application->selected_division_id;
        } elseif ($request->status === 'rejected') {
            $approvedDivisionId = null;
        }

        $application->update([
            'status' => $request->status,
            'approved_division_id' => $approvedDivisionId,
            'hrd_notes' => $request->hrd_notes,
        ]);

        return back()->with('success', 'Status keputusan lamaran berhasil diperbarui.');
    }
}
