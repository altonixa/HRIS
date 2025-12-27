<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use App\Models\Appraisal;
use App\Models\AppraisalMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppraisalReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch appraisals. Ideally filter by department if Department Head.
        // For HR Manager, seeing all or filtering by status.
        $appraisals = Appraisal::with(['employee', 'employee.department'])
            ->latest('created_at')
            ->paginate(10);
            
        return view('admin.hr.appraisals.index', compact('appraisals'));
    }

    /**
     * Show the form for editing (reviewing) the specified resource.
     */
    public function edit(Appraisal $appraisal)
    {
        $appraisal->load(['metrics.kpi', 'employee']);

        return view('admin.hr.appraisals.edit', compact('appraisal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appraisal $appraisal)
    {
        $request->validate([
            'manager_ratings' => 'required|array',
            'manager_ratings.*' => 'required|numeric|min:0|max:10',
            'final_comments' => 'nullable|string',
            'action' => 'required|in:save,finalize'
        ]);

        DB::transaction(function () use ($request, $appraisal) {
            $totalWeightedScore = 0;
            $totalWeight = 0;

            foreach ($request->manager_ratings as $metricId => $score) {
                $metric = AppraisalMetric::with('kpi')->find($metricId);
                if ($metric) {
                    $metric->manager_score = $score;
                    $metric->save();

                    // Calculate score contribution
                    // Assuming KPI weight is percentage (e.g. 25 for 25%)
                    // Score is 0-10.
                    // Contribution = Score * (Weight / 100)
                    $weight = $metric->kpi->weight;
                    $totalWeight += $weight;
                    $totalWeightedScore += ($score * ($weight / 100));
                }
            }

            // Update Appraisal
            $appraisal->evaluator_id = Auth::id();
            $appraisal->comments = $request->final_comments;
            
            // Normalize score if weights don't sum to 100? 
            // For now, assume they sum to 100. If they sum to 50, the score is out of 5?
            // Let's normalize to 10 scale if totalWeight > 0
            if ($totalWeight > 0) {
                 // Example: Total Weight = 50. Weighted Score = 4. 
                 // Real scale (0-10): 4 / (50/100) = 8.
                 $appraisal->total_score = $totalWeightedScore / ($totalWeight / 100);
            } else {
                $appraisal->total_score = 0;
            }

            if ($request->action === 'finalize') {
                $appraisal->status = 'Finalized';
            } else {
                $appraisal->status = 'Reviewed';
            }
            
            $appraisal->save();
        });

        return redirect()->route('hr-manager.appraisals.index')
            ->with('success', 'Appraisal review saved successfully.');
    }
    
    // ... possibly destroy, show if needed
}
