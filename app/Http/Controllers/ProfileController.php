<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        $employee = $user->employee;
        
        return view('profile.edit', compact('user', 'employee'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $employee = $user->employee;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'town' => ['nullable', 'string', 'max:100'],
            'quarter' => ['nullable', 'string', 'max:100'],
            'national_id_card' => ['nullable', 'string', 'max:50'],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // 2MB max
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Update User Account (Name/Email/Password)
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        // Update Employee Profile (If linked)
        if ($employee) {
            $employee_data = [
                'phone' => $request->phone,
                'address' => $request->address,
                'town' => $request->town,
                'quarter' => $request->quarter,
                'national_id_card' => $request->national_id_card,
            ];

            // Handle Profile Picture Upload
            if ($request->hasFile('profile_picture')) {
                // Delete old if exists
                if ($employee->profile_picture) {
                    Storage::delete($employee->profile_picture);
                }
                
                $path = $request->file('profile_picture')->store('public/avatars');
                $employee_data['profile_picture'] = $path;
            }

            $employee->update($employee_data);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
