<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\KPI;
use App\Models\Department;
use Illuminate\Http\Request;

class KPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kpis = KPI::with('department')->latest()->paginate(10);
        $departments = Department::all();
        
        return view('admin.hr.kpis.index', compact('kpis', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0|max:100',
            'target_value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        KPI::create($validated);

        return redirect()->route('hr-manager.kpis.index')
            ->with('success', 'KPI created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KPI $kpi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0|max:100',
            'target_value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $kpi->update($validated);

        return redirect()->route('hr-manager.kpis.index')
            ->with('success', 'KPI updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KPI $kpi)
    {
        $kpi->delete();

        return redirect()->route('hr-manager.kpis.index')
            ->with('success', 'KPI deleted successfully.');
    }
}
