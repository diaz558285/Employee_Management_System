<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Payslip;

class PayslipController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            return redirect()->route('dashboard')->with('error', 'Your account is not yet linked to your employee payslip. Please contact HR.');
        }

        $payslips = $employee->payslips()->latest()->paginate(15);
        return view('employee.payslips.index', compact('payslips'));
    }

    public function show(Payslip $payslip)
    {
        if ($payslip->employee_id !== auth()->user()->employee->id) abort(403);
        return view('employee.payslips.show', compact('payslip'));
    }
}