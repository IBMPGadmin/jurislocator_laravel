<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'user_type' => ['required', 'in:licensed_practitioner,immigration_lawyer,notaire_quebec,student_queens,student_montreal'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // Add conditional validation based on user type
        if (in_array($request->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec'])) {
            $rules['license_number'] = ['required', 'string', 'max:255'];
        } elseif (in_array($request->user_type, ['student_queens', 'student_montreal'])) {
            $rules['student_id_number'] = ['required', 'string', 'max:255'];
            $rules['student_id_file'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'];
        }

        $validated = $request->validate($rules);

        // Handle file upload for student ID
        $studentIdFile = null;
        if ($request->hasFile('student_id_file')) {
            $studentIdFile = $request->file('student_id_file')->store('student_ids', 'public');
        }

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'user_type' => $validated['user_type'],
            'license_number' => $request->license_number ?? null,
            'student_id_number' => $request->student_id_number ?? null,
            'student_id_file' => $studentIdFile,
            'company_name' => $request->company_name ?? null,
            'approval_status' => 'pending',
            'password' => Hash::make($validated['password']),
        ]);

        // Create trial subscription but don't activate until approved
        UserSubscription::create([
            'user_id' => $user->id,
            'trial_starts_at' => null, // Will be set when approved
            'trial_ends_at' => null,   // Will be set when approved
            'status' => 'pending'      // Pending until user is approved
        ]);

        event(new Registered($user));

        // Don't login the user, redirect to pending approval page
        return redirect()->route('auth.pending-approval');
    }

    /**
     * Display the pending approval view.
     */
    public function pendingApproval(): View
    {
        return view('auth.pending-approval');
    }
}
