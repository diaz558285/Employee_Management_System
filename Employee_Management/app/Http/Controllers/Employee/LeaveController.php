<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            return redirect()->route('dashboard')->with('error', 'No employee record found. Please contact HR.');
        }

        $leaves = $employee->leaveRequests()->latest()->paginate(15);
        return view('employee.leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('employee.leaves.create');
    }

    public function store(Request $request)
    {
        $employee = auth()->user()->employee;
        $request->validate([
            'type'       => 'required|in:sick,vacation,emergency,maternity,paternity,unpaid',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string',
        ]);

        $days = (int) \Carbon\Carbon::parse($request->start_date)->diffInWeekdays(\Carbon\Carbon::parse($request->end_date)) + 1;

        LeaveRequest::create([
            'employee_id' => $employee->id,
            'type'        => $request->type,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'days_count'  => $days,
            'reason'      => $request->reason,
            'status'      => 'pending',
        ]);

        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'leave request submitted',
            'description' => "Submitted {$request->type} leave request",
        ]);

        return redirect()->route('employee.leaves.index')->with('success', 'Leave request submitted.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->employee_id !== auth()->user()->employee->id) abort(403);
        return view('employee.leaves.show', compact('leaveRequest'));
    }
}