<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            return redirect()->route('dashboard')->with('error', 'No employee record found. Please contact HR.');
        }

        $employee->load(['department', 'manager']);
        return view('employee.profile.show', compact('employee'));
    }

    public function update(Request $request)
    {
        $employee = auth()->user()->employee;

        $request->validate([
            'phone'                 => 'nullable|string|max:20',
            'address'               => 'nullable|string',
            'current_password'      => 'nullable|required_with:new_password',
            'new_password'          => 'nullable|min:8|confirmed',
        ]);

        // Update employee info
        $employee->update($request->only('phone', 'address'));

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            auth()->user()->update([
                'password' => Hash::make($request->new_password),
            ]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}