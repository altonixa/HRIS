<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ExpenseClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $claims = ExpenseClaim::where('employee_id', $employee->id)->latest()->paginate(10);
        return view('admin.employee.expenses.index', compact('claims'));
    }

    public function create()
    {
        return view('admin.employee.expenses.create');
    }

    public function store(Request $request)
    {
        $employee = Auth::user()->employee;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'claim_date' => 'required|date',
            'description' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('receipt')) {
            $validated['receipt_path'] = $request->file('receipt')->store('receipts');
        }

        $validated['employee_id'] = $employee->id;
        $validated['status'] = 'pending';

        ExpenseClaim::create($validated);

        return redirect()->route('employee.expenses.index')->with('success', 'Expense claim submitted for review.');
    }
}
