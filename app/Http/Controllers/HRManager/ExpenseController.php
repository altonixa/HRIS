<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\ExpenseClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $claims = ExpenseClaim::with('employee')->latest()->paginate(15);
        return view('admin.hr.expenses.index', compact('claims'));
    }

    public function update(Request $request, ExpenseClaim $expenseClaim)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,paid',
            'remarks' => 'nullable|string',
        ]);

        $expenseClaim->update([
            'status' => $validated['status'],
            'approval_remarks' => $validated['remarks'],
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('hr-manager.expenses.index')->with('success', 'Claim status updated.');
    }
}
