<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user->hasRole('Super Admin')) {
            return redirect()->route('super-admin.dashboard');
        }

        if ($user->hasRole('Organization Admin') || $user->hasRole('Executive')) {
             return redirect()->route('super-admin.dashboard'); // Using this for high-level overview
        }

        if ($user->hasRole('HR Manager')) {
            return redirect()->route('hr-manager.dashboard');
        }

        if ($user->hasRole('Department Head')) {
            return redirect()->route('department-head.dashboard');
        }

        if ($user->hasRole('Accountant') || $user->hasRole('Finance')) {
            return redirect()->route('accountant.dashboard');
        }

        if ($user->hasRole('Employee') || $user->hasRole('Volunteer')) {
            return redirect()->route('employee.dashboard');
        }

        abort(403, 'User does not have an assigned role.');
    }
}
