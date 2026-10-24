<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Redirect authenticated user to their role-specific dashboard.
     */
    public static function redirectByRole(?User $user = null): RedirectResponse
    {
        $user = $user ?? Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        }

        if ($user->isHrd()) {
            return redirect()->route('hrd.dashboard');
        }

        return redirect()->route('applicant.dashboard');
    }

    /**
     * Handle registration for new applicants.
     */
    public function registerApplicant(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:mahasiswa,umum'],
            'institution' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'applicant',
        ]);

        ApplicantProfile::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'institution' => $request->institution,
            'phone' => $request->phone,
        ]);

        Auth::login($user);

        return redirect()->route('applicant.dashboard');
    }
}
