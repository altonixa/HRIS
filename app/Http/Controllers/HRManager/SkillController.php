<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('name')->get();
        return view('admin.hr.training.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:skills,name|max:255',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Skill::create($validated);

        return back()->with('success', 'New skill added to catalog.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill removed from catalog.');
    }
}
