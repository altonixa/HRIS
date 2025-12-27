<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $trainings = Training::with('course')
            ->where('employee_id', $employee->id)
            ->latest()
            ->get();
            
        return view('admin.employee.training.index', compact('trainings'));
    }
}
