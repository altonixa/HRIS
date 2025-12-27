<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appraisal;
use App\Models\AppraisalMetric;
use App\Models\KPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppraisalController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')->with('error', 'Employee profile not found.');
        }

        $appraisals = Appraisal::where('employee_id', $employee->id)
            ->with(['evaluator.employee'])
            ->latest('period_end')
            ->paginate(10);

        return view('admin.employee.appraisals.index', compact('appraisals'));
    }

    public function create()
    {
        $employee = Auth::user()->employee;
        
        // Fetch KPIs: Global + Department specific
        $kpis = KPI::whereNull('department_id')
            ->orWhere('department_id', $employee->department_id)
            ->get();

        return view('admin.employee.appraisals.create', compact('kpis', 'employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:period_start',
            'ratings' => 'required|array',
            'ratings.*' => 'required|numeric|min:0|max:10', // Assuming 0-10 scale
            'comments' => 'nullable|array',
        ]);

        $employee = Auth::user()->employee;

        DB::transaction(function () use ($request, $employee) {
            // Create Appraisal Draft
            $appraisal = Appraisal::create([
                'employee_id' => $employee->id,
                'evaluator_id' => null, // To be assigned or picked by HR?
                'period_start' => $request->period_start,
                'period_end' => $request->period_end,
                'status' => 'Submitted',
                'comments' => $request->general_comments ?? null,
            ]);

            // Save Metrics
            foreach ($request->ratings as $kpiId => $score) {
                AppraisalMetric::create([
                    'appraisal_id' => $appraisal->id,
                    'kpi_id' => $kpiId,
                    'self_score' => $score,
                    'comments' => $request->comments[$kpiId] ?? null,
                ]);
            }
        });

        return redirect()->route('employee.appraisals.index')
            ->with('success', 'Self-appraisal submitted successfully.');
    }

    public function show(Appraisal $appraisal)
    {
        $this->authorize('view', $appraisal); // Need policies! Or manual check
        
        if ($appraisal->employee_id !== Auth::user()->employee->id) {
            abort(403);
        }

        $appraisal->load(['metrics.kpi', 'evaluator']);

        return view('admin.employee.appraisals.show', compact('appraisal'));
    }
}
