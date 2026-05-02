<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id','employee_number','first_name','last_name','middle_name',
        'birthdate','gender','civil_status','phone','address','position',
        'department_id','manager_id','date_hired','employment_type','status',
        'basic_salary','sss_number','philhealth_number','pagibig_number',
        'tin_number','bank_account',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function department() { return $this->belongsTo(Department::class); }
    public function manager() { return $this->belongsTo(User::class, 'manager_id'); }
    public function payslips() { return $this->hasMany(Payslip::class); }
    public function leaveRequests() { return $this->hasMany(LeaveRequest::class); }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}