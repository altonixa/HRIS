<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::with('jobPosting');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('job_id')) {
            $query->where('job_posting_id', $request->job_id);
        }

        $applications = $query->latest()->paginate(10);
        
        return view('admin.hr.recruitment.applications.index', compact('applications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $application)
    {
        return view('admin.hr.recruitment.applications.show', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:New,Screening,Interview,Offered,Rejected,Hired',
            'notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application status updated.');
    }
}
