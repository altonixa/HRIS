<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $employee = \Illuminate\Support\Facades\Auth::user()->employee;
        $employee->load(['documents', 'emergencyContacts', 'department', 'designation', 'manager']);
        
        return view('admin.employee.profile', compact('employee'));
    }
}
