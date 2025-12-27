<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return view('admin.hr.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('admin.hr.shifts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'grace_period_minutes' => 'required|integer|min:0',
        ]);

        Shift::create($request->all());

        return redirect()->route('hr-manager.shifts.index')
            ->with('success', 'Shift schedule created successfully.');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();
        return back()->with('success', 'Shift deleted successfully.');
    }
}
