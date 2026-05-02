<?php
namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        $payslips = Payslip::with('employee')
            ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id))
            ->latest()->paginate(20);
        $employees = Employee::where('status', 'active')->get();
        return view('hr.payslips.index', compact('payslips', 'employees'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('hr.payslips.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'  => 'required|exists:employees,id',
            'period_label' => 'required|string',
            'pay_date'     => 'required|date',
            'period_start' => 'required|date',
            'period_end'   => 'required|date|after_or_equal:period_start',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['gross_pay'] = $data['basic_salary'] + ($data['overtime_pay'] ?? 0) + ($data['allowances'] ?? 0);
        $data['total_deductions'] = ($data['sss'] ?? 0) + ($data['philhealth'] ?? 0) + ($data['pagibig'] ?? 0)
            + ($data['withholding_tax'] ?? 0) + ($data['other_deductions'] ?? 0);
        $data['net_pay'] = $data['gross_pay'] - $data['total_deductions'];

        Payslip::create($data);
        return redirect()->route('hr.payslips.index')->with('success', 'Payslip generated.');
    }

    public function show(Payslip $payslip)
    {
        $payslip->load('employee.department');
        return view('hr.payslips.show', compact('payslip'));
    }

    public function edit(Payslip $payslip)
    {
        $employees = Employee::where('status', 'active')->get();
        return view('hr.payslips.edit', compact('payslip', 'employees'));
    }

    public function update(Request $request, Payslip $payslip)
    {
        $request->validate([
            'basic_salary' => 'required|numeric|min:0',
            'pay_date'     => 'required|date',
        ]);

        $data = $request->all();
        $data['gross_pay'] = $data['basic_salary'] + ($data['overtime_pay'] ?? 0) + ($data['allowances'] ?? 0);
        $data['total_deductions'] = ($data['sss'] ?? 0) + ($data['philhealth'] ?? 0) + ($data['pagibig'] ?? 0)
            + ($data['withholding_tax'] ?? 0) + ($data['other_deductions'] ?? 0);
        $data['net_pay'] = $data['gross_pay'] - $data['total_deductions'];

        $payslip->update($data);
        return redirect()->route('hr.payslips.index')->with('success', 'Payslip updated.');
    }
}