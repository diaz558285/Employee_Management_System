<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeViewController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();
        $employees = Employee::with(['department', 'user'])
            ->when($request->search, fn($q) => $q->where('first_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%")
                ->orWhere('employee_number', 'like', "%{$request->search}%"))
            ->when($request->department_id, fn($q) => $q->where('department_id', $request->department_id))
            ->paginate(15);
        return view('admin.employees.index', compact('employees', 'departments'));
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'user', 'manager']);
        return view('admin.employees.show', compact('employee'));
    }
}