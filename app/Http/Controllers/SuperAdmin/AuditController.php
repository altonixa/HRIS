<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')->latest()->paginate(25);
        return view('admin.super.audit.index', compact('logs'));
    }
}
