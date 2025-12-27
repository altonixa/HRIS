namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            abort(403, 'No employee record linked to this user.');
        }

        // Get today's log
        $todayLog = AttendanceLog::where('employee_id', $employee->id)
            ->where('date', Carbon::today())
            ->first();

        // Get history
        $logs = AttendanceLog::where('employee_id', $employee->id)
            ->latest('date')
            ->paginate(10);

        return view('employee.attendance.index', compact('todayLog', 'logs'));
    }

    public function clockIn(Request $request)
    {
        $employee = Auth::user()->employee;
        
        // Prevent double clock-in
        $existingLog = AttendanceLog::where('employee_id', $employee->id)
            ->where('date', Carbon::today())
            ->first();

        if ($existingLog) {
            return back()->with('error', 'You have already clocked in today.');
        }

        AttendanceLog::create([
            'employee_id' => $employee->id,
            'date' => Carbon::today(),
            'clock_in' => Carbon::now()->format('H:i:s'),
            'status' => 'present', // Logic for 'late' can be added here based on Shift
            'clock_in_ip' => $request->ip(),
        ]);

        return back()->with('success', 'Clocked in successfully at ' . Carbon::now()->format('H:i A'));
    }

    public function clockOut(Request $request)
    {
        $employee = Auth::user()->employee;
        
        $log = AttendanceLog::where('employee_id', $employee->id)
            ->where('date', Carbon::today())
            ->first();

        if (!$log) {
            return back()->with('error', 'You have not clocked in today.');
        }

        if ($log->clock_out) {
            return back()->with('error', 'You have already clocked out.');
        }

        $log->update([
            'clock_out' => Carbon::now()->format('H:i:s'),
            'clock_out_ip' => $request->ip(),
        ]);

        return back()->with('success', 'Clocked out successfully at ' . Carbon::now()->format('H:i A'));
    }
}
