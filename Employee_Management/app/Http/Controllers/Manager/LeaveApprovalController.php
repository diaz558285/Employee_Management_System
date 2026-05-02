<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function index(Request $request)
    {
        // Only show leaves for this manager's team
        $leaves = LeaveRequest::with(['employee.user'])
            ->whereHas('employee', fn($q) => $q->where('manager_id', auth()->id()))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()->paginate(20);
        return view('manager.leaves.index', compact('leaves'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->employee->manager_id !== auth()->id()) abort(403);

        $request->validate([
            'status'          => 'required|in:approved,rejected',
            'manager_comment' => 'nullable|string',
        ]);

        $leaveRequest->update([
            'status'          => $request->status,
            'manager_comment' => $request->manager_comment,
            'reviewed_by'     => auth()->id(),
            'reviewed_at'     => now(),
        ]);

        return back()->with('success', "Leave request {$request->status}.");
    }
}