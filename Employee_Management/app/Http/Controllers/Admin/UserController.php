<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('department')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        // Only employees without a user account yet
        $employees = Employee::whereNull('user_id')
            ->orWhereDoesntHave('user')
            ->get();
        return view('admin.users.create', compact('departments', 'employees'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8|confirmed',
            'role'          => 'required|in:admin,hr,manager,employee',
            'department_id' => 'nullable|exists:departments,id',
        ];

        // If role is employee, require employee_id
        if ($request->role === 'employee') {
            $rules['employee_id'] = 'required|exists:employees,id';
        }

        $data = $request->validate($rules);
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;

        // Remove employee_id from user data before creating
        $employeeId = $data['employee_id'] ?? null;
        unset($data['employee_id']);

        $user = User::create($data);

        // Link employee record to this user
        if ($request->role === 'employee' && $employeeId) {
            Employee::where('id', $employeeId)->update(['user_id' => $user->id]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $departments = Department::where('is_active', true)->get();
        return view('admin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'role'          => 'required|in:admin,hr,manager,employee',
            'department_id' => 'nullable|exists:departments,id',
            'password'      => 'nullable|min:8|confirmed',
        ]);
        if (empty($data['password'])) unset($data['password']);
        else $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->update(['is_active' => false]);
        return back()->with('success', 'User deactivated.');
    }
}