<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $pendingLeaves = LeaveRequest::with(['employee', 'leaveType'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $history = LeaveRequest::with(['employee', 'leaveType', 'approver'])
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->paginate(15);

        return view('admin.hr.leaves.index', compact('pendingLeaves', 'history'));
    }

    public function update(Request $request, LeaveRequest $leave)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:255',
        ]);

        $leave->update([
            'status' => $request->status,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        // If approved, we might want to log this in attendance logs in the future?
        // For now, just updating status is enough.

        return back()->with('success', 'Leave request ' . $request->status . ' successfully.');
    }
}
