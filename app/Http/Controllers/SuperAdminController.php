<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Division;
use App\Models\MatrixWeight;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminController extends Controller
{
    /**
     * Super Admin overview dashboard.
     */
    public function dashboard(): View
    {
        $divisionCount = Division::count();
        $criteriaCount = Criterion::count();
        $questionCount = Question::count();
        $matrixWeightsCount = MatrixWeight::count();
        $totalUsers = User::count();
        $hrdCount = User::where('role', 'hrd')->count();
        $applicantCount = User::where('role', 'applicant')->count();

        $divisions = Division::withCount('matrixWeights')->get();
        $criteria = Criterion::withCount('questions')->get();

        return view('dashboard.superadmin.index', compact(
            'divisionCount',
            'criteriaCount',
            'questionCount',
            'matrixWeightsCount',
            'totalUsers',
            'hrdCount',
            'applicantCount',
            'divisions',
            'criteria'
        ));
    }

    /**
     * Master Data: Divisions index.
     */
    public function divisions(): View
    {
        $divisions = Division::withCount('matrixWeights')->get();
        return view('dashboard.superadmin.divisions', compact('divisions'));
    }

    public function storeDivision(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $division = Division::create($request->only('name', 'description'));

        // Initialize default weights for all criteria (0%)
        $criteria = Criterion::all();
        foreach ($criteria as $criterion) {
            MatrixWeight::create([
                'division_id' => $division->id,
                'criteria_id' => $criterion->id,
                'weight_percentage' => 0.00,
            ]);
        }

        return back()->with('success', 'Divisi baru berhasil ditambahkan.');
    }

    public function updateDivision(Request $request, Division $division): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $division->update($request->only('name', 'description'));

        return back()->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function destroyDivision(Division $division): RedirectResponse
    {
        $division->delete();
        return back()->with('success', 'Divisi berhasil dihapus.');
    }

    /**
     * Master Data: Criteria & Questions.
     */
    public function criteria(): View
    {
        $criteria = Criterion::with('questions')->get();
        return view('dashboard.superadmin.criteria', compact('criteria'));
    }

    public function updateCriterion(Request $request, Criterion $criterion): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $criterion->update($request->only('name'));

        return back()->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function storeQuestion(Request $request): RedirectResponse
    {
        $request->validate([
            'criteria_id' => 'required|exists:criteria,id',
            'question_text' => 'required|string',
            'order_num' => 'nullable|integer',
        ]);

        $order = $request->order_num ?: (Question::max('order_num') + 1);

        Question::create([
            'criteria_id' => $request->criteria_id,
            'question_text' => $request->question_text,
            'order_num' => $order,
        ]);

        return back()->with('success', 'Pertanyaan baru berhasil ditambahkan.');
    }

    public function updateQuestion(Request $request, Question $question): RedirectResponse
    {
        $request->validate([
            'criteria_id' => 'required|exists:criteria,id',
            'question_text' => 'required|string',
            'order_num' => 'nullable|integer',
        ]);

        $question->update($request->only('criteria_id', 'question_text', 'order_num'));

        return back()->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroyQuestion(Question $question): RedirectResponse
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }

    /**
     * Dynamic Matrix Weights Management.
     */
    public function matrixWeights(): View
    {
        $divisions = Division::with(['matrixWeights.criterion'])->get();
        $criteria = Criterion::orderBy('code')->get();

        return view('dashboard.superadmin.matrix-weights', compact('divisions', 'criteria'));
    }

    public function updateMatrixWeights(Request $request): RedirectResponse
    {
        $weights = $request->input('weights', []); // format: [division_id => [criteria_id => weight_percentage]]

        foreach ($weights as $divisionId => $criteriaWeights) {
            foreach ($criteriaWeights as $criteriaId => $percentage) {
                MatrixWeight::updateOrCreate(
                    [
                        'division_id' => $divisionId,
                        'criteria_id' => $criteriaId,
                    ],
                    [
                        'weight_percentage' => floatval($percentage),
                    ]
                );
            }
        }

        return back()->with('success', 'Matriks bobot kriteria divisi berhasil disimpan.');
    }
}
