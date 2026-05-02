<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with(['department', 'user'])
            ->where('manager_id', auth()->id())
            ->when($request->search, fn($q) => $q->where('first_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%"))
            ->paginate(15);
        return view('manager.team.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        if ($employee->manager_id !== auth()->id()) abort(403);
        $employee->load(['department', 'user']);
        return view('manager.team.show', compact('employee'));
    }
}