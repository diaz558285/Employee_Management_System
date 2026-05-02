<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = [
        'employee_id','period_label','pay_date','period_start','period_end',
        'basic_salary','overtime_pay','allowances','gross_pay',
        'sss','philhealth','pagibig','withholding_tax','other_deductions',
        'total_deductions','net_pay','notes',
    ];

    public function employee() { return $this->belongsTo(Employee::class); }
}