<?php
namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveMonitorController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();
        $leaves = LeaveRequest::with(['employee.user', 'reviewer'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id))
            ->latest()->paginate(20);
        return view('hr.leaves.index', compact('leaves', 'employees'));
    }

    public function show(LeaveRequest $leaveRequest)
    {
        $leaveRequest->load(['employee.user', 'reviewer']);
        return view('hr.leaves.show', compact('leaveRequest'));
    }
}