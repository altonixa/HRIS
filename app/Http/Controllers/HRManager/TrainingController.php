<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Course;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['employee', 'course'])->latest()->paginate(15);
        return view('admin.hr.training.assignments.index', compact('trainings'));
    }

    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        return view('admin.hr.training.assignments.create', compact('courses', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        Training::create($validated);

        return redirect()->route('hr-manager.trainings.index')->with('success', 'Training assigned successfully.');
    }

    public function edit(Training $training)
    {
        $courses = Course::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        return view('admin.hr.training.assignments.edit', compact('training', 'courses', 'employees'));
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'status' => 'required|in:assigned,in_progress,completed,failed',
            'score' => 'nullable|integer|min:0|max:100',
            'completion_date' => 'nullable|required_if:status,completed|date',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('certificate')) {
            // Delete old certificate if exists
            if ($training->certificate_path) {
                Storage::delete($training->certificate_path);
            }
            $validated['certificate_path'] = $request->file('certificate')->store('certificates');
        }

        $training->update($validated);

        return redirect()->route('hr-manager.trainings.index')->with('success', 'Training record updated.');
    }

    public function destroy(Training $training)
    {
        if ($training->certificate_path) {
            Storage::delete($training->certificate_path);
        }
        $training->delete();
        return redirect()->route('hr-manager.trainings.index')->with('success', 'Training record removed.');
    }
}
