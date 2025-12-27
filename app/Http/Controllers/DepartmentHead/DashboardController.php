<?php

namespace App\Http\Controllers\DepartmentHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Scoped data will be passed here later
    }
}
