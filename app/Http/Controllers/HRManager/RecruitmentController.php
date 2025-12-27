<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Department;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobPosting::withCount('applications')->latest()->paginate(10);
        return view('admin.hr.recruitment.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.hr.recruitment.jobs.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:Full-time,Part-time,Contract,Internship,Remote',
            'salary_range' => 'nullable|string|max:100',
            'closing_date' => 'nullable|date',
            'status' => 'required|in:Draft,Published,Closed',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
        ]);

        JobPosting::create($validated);

        return redirect()->route('hr-manager.recruitment.index')
            ->with('success', 'Job posting created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosting $jobPosting)
    {
        $departments = Department::all();
        return view('admin.hr.recruitment.jobs.edit', compact('jobPosting', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:Full-time,Part-time,Contract,Internship,Remote',
            'salary_range' => 'nullable|string|max:100',
            'closing_date' => 'nullable|date',
            'status' => 'required|in:Draft,Published,Closed',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
        ]);

        $jobPosting->update($validated);

        return redirect()->route('hr-manager.recruitment.index')
            ->with('success', 'Job posting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();

        return redirect()->route('hr-manager.recruitment.index')
            ->with('success', 'Job posting deleted.');
    }
}
