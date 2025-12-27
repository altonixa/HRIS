<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'is_primary' => 'boolean',
        ]);

        if ($request->is_primary) {
            \App\Models\EmergencyContact::where('employee_id', $request->employee_id)
                ->update(['is_primary' => false]);
        }

        \App\Models\EmergencyContact::create($validated);

        return back()->with('success', 'Emergency contact added successfully!');
    }

    public function destroy(\App\Models\EmergencyContact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Emergency contact removed successfully!');
    }
}
