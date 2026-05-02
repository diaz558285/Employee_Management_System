<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\Payslip;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'totalUsers'       => User::count(),
                'totalDepartments' => Department::count(),
                'totalEmployees'   => Employee::count(),
                'activeEmployees'  => Employee::where('status', 'active')->count(),
                'pendingLeaves'    => LeaveRequest::where('status', 'pending')->count(),
            ]);
        }

        if ($user->isHR()) {
            return view('dashboard.hr', [
                'totalEmployees'   => Employee::count(),
                'activeEmployees'  => Employee::where('status', 'active')->count(),
                'pendingLeaves'    => LeaveRequest::where('status', 'pending')->count(),
                'recentPayslips'   => Payslip::latest()->take(5)->with('employee')->get(),
            ]);
        }

        if ($user->isManager()) {
            $teamIds = Employee::where('manager_id', $user->id)->pluck('id');
            return view('dashboard.manager', [
                'teamCount'     => $teamIds->count(),
                'pendingLeaves' => LeaveRequest::whereIn('employee_id', $teamIds)->where('status', 'pending')->count(),
            ]);
        }

        // Employee
        $employee = $user->employee;
        return view('dashboard.employee', [
            'employee'        => $employee?->load('department'),
            'recentLeaves'    => $employee ? LeaveRequest::where('employee_id', $employee->id)->latest()->take(3)->get() : collect(),
            'recentPayslips'  => $employee ? Payslip::where('employee_id', $employee->id)->where('status', 'released')->latest()->take(3)->get() : collect(),
        ]);
    }
}