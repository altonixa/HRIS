<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\Employee;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['assignments' => function($q) {
            $q->where('status', 'active')->with('employee');
        }])->latest()->paginate(15);
        $employees = Employee::where('status', 'active')->orderBy('first_name')->get();
        return view('admin.hr.assets.index', compact('assets', 'employees'));
    }

    public function create()
    {
        return view('admin.hr.assets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'asset_code' => 'required|string|unique:assets,asset_code',
            'category' => 'required|string',
            'serial_number' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'value' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        Asset::create($validated);

        return redirect()->route('hr-manager.assets.index')->with('success', 'Asset added to inventory.');
    }

    public function assign(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'assigned_date' => 'required|date',
            'condition_on_assign' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $asset->assignments()->create([
            'employee_id' => $validated['employee_id'],
            'assigned_date' => $validated['assigned_date'],
            'condition_on_assign' => $validated['condition_on_assign'],
            'notes' => $validated['notes'],
            'status' => 'active',
        ]);

        $asset->update(['status' => 'assigned']);

        return back()->with('success', 'Asset assigned successfully.');
    }

    public function return(Request $request, AssetAssignment $assignment)
    {
        $validated = $request->validate([
            'returned_date' => 'required|date',
            'condition_on_return' => 'nullable|string',
        ]);

        $assignment->update([
            'returned_date' => $validated['returned_date'],
            'condition_on_return' => $validated['condition_on_return'],
            'status' => 'returned',
        ]);

        $assignment->asset->update(['status' => 'available']);

        return back()->with('success', 'Asset returned to inventory.');
    }
}
