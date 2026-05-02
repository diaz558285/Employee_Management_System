<?php
namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();
        $employees = Employee::with(['department', 'user'])
            ->when($request->search, fn($q) => $q->where('first_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%"))
            ->when($request->department_id, fn($q) => $q->where('department_id', $request->department_id))
            ->paginate(15);
        return view('hr.employees.index', compact('employees', 'departments'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        $managers = User::where('role', 'manager')->where('is_active', true)->get();
        return view('hr.employees.create', compact('departments', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'email'           => 'required|email|unique:users,email',
            'position'        => 'required|string',
            'department_id'   => 'required|exists:departments,id',
            'date_hired'      => 'required|date',
            'basic_salary'    => 'required|numeric|min:0',
            'employment_type' => 'required|in:regular,contractual,probationary',
        ]);

        // ✅ Step 1 — Auto create user account
        $user = User::create([
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make('password123'),
            'role'          => 'employee',
            'is_active'     => true,
            'department_id' => $request->department_id,
        ]);

        // ✅ Step 2 — Create employee record linked to user
        $empNum = 'EMP-' . str_pad(Employee::count() + 1, 5, '0', STR_PAD_LEFT);

        Employee::create(array_merge($request->except('email'), [
            'employee_number' => $empNum,
            'user_id'         => $user->id,
        ]));

        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'created employee',
            'description' => "Created employee and user account for {$request->first_name} {$request->last_name}",
        ]);

        return redirect()->route('hr.employees.index')
            ->with('success', "Employee created successfully. Login: {$request->email} | Default password: password123");
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'user', 'manager', 'leaveRequests', 'payslips']);
        return view('hr.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::where('is_active', true)->get();
        $managers = User::where('role', 'manager')->where('is_active', true)->get();
        return view('hr.employees.edit', compact('employee', 'departments', 'managers'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'position'        => 'required|string',
            'department_id'   => 'required|exists:departments,id',
            'basic_salary'    => 'required|numeric|min:0',
            'employment_type' => 'required|in:regular,contractual,probationary',
            'status'          => 'required|in:active,inactive',
        ]);

        $employee->update($request->all());

        // Also update the linked user name if name changed
        if ($employee->user) {
            $employee->user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
            ]);
        }

        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'updated employee',
            'description' => "Updated employee record for {$employee->full_name}",
        ]);

        return redirect()->route('hr.employees.index')->with('success', 'Employee updated.');
    }
}