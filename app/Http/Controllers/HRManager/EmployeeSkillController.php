<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSkill;
use App\Models\Skill;
use Illuminate\Http\Request;

class EmployeeSkillController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'skill_id' => 'required|exists:skills,id',
            'proficiency' => 'required|integer|min:1|max:5',
            'years_of_experience' => 'nullable|integer|min:0',
        ]);

        EmployeeSkill::updateOrCreate(
            ['employee_id' => $request->employee_id, 'skill_id' => $request->skill_id],
            $validated
        );

        return back()->with('success', 'Skill matrix updated.');
    }

    public function destroy(EmployeeSkill $employeeSkill)
    {
        $employeeSkill->delete();
        return back()->with('success', 'Skill removed from profile.');
    }
}
