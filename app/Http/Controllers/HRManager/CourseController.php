<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.hr.training.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.hr.training.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code',
            'category' => 'nullable|string',
            'provider' => 'nullable|string',
            'duration_hours' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()->route('hr-manager.courses.index')->with('success', 'Course catalog updated.');
    }

    public function edit(Course $course)
    {
        return view('admin.hr.training.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code,' . $course->id,
            'category' => 'nullable|string',
            'provider' => 'nullable|string',
            'duration_hours' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:active,archived',
        ]);

        $course->update($validated);

        return redirect()->route('hr-manager.courses.index')->with('success', 'Course information updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('hr-manager.courses.index')->with('success', 'Course removed from catalog.');
    }
}
