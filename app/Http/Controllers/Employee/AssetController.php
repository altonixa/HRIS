<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $assignments = AssetAssignment::with('asset')
            ->where('employee_id', $employee->id)
            ->where('status', 'active')
            ->get();
            
        return view('admin.employee.assets.index', compact('assignments'));
    }
}
