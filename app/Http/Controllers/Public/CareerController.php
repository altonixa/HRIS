<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::published()
            ->with('department')
            ->latest()
            ->paginate(9);

        return view('job-board.index', compact('jobs'));
    }

    public function show(JobPosting $job)
    {
        if ($job->status !== 'Published') {
            abort(404);
        }
        
        return view('job-board.show', compact('job'));
    }

    public function apply(Request $request, JobPosting $job)
    {
        if ($job->status !== 'Published') {
            abort(404);
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // 2MB max
            'cover_letter' => 'nullable|string',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes');
        }

        JobApplication::create([
            'job_posting_id' => $job->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'status' => 'New',
        ]);

        return redirect()->route('careers.show', $job)
            ->with('success', 'Application submitted successfully! We will review it shortly.');
    }
}
