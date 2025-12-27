<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'designation', 'user'])
            ->latest()
            ->paginate(10);
            
        return view('admin.hr.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::where('status', 'active')->get();
        $designations = Designation::where('status', 'active')->get();
        
        return view('admin.hr.employees.create', compact('departments', 'designations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'employee_code' => 'required|string|unique:employees,employee_code',
            'joining_date' => 'required|date',
            'department_id' => 'nullable|exists:departments,id',
            'designation_id' => 'nullable|exists:designations,id',
        ]);

        \DB::beginTransaction();
        try {
            // Create User Account
            $user = \App\Models\User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => \Hash::make('password123'), // Temporary password
                'force_password_change' => true,
            ]);

            // Assign Employee Role
            $user->assignRole('Employee');

            // Create Employee Profile
            $employee = Employee::create([
                'user_id' => $user->id,
                'employee_code' => $validated['employee_code'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'joining_date' => $validated['joining_date'],
                'department_id' => $validated['department_id'],
                'designation_id' => $validated['designation_id'],
                'status' => 'probation',
            ]);

            \DB::commit();

            return redirect()->route('hr-manager.employees.index')
                ->with('success', 'Employee created successfully!');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Failed to create employee: ' . $e->getMessage()]);
        }
    }

    public function show(Employee $employee)
    {
        $employee->load(['documents', 'emergencyContacts', 'department', 'designation', 'user', 'manager', 'trainings.course', 'skills']);
        $allSkills = \App\Models\Skill::orderBy('name')->get();
        return view('admin.hr.employees.show', compact('employee', 'allSkills'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::where('status', 'active')->get();
        $designations = Designation::where('status', 'active')->get();
        $managers = Employee::where('id', '!=', $employee->id)->get();
        
        return view('admin.hr.employees.edit', compact('employee', 'departments', 'designations', 'managers'));
    }
}
