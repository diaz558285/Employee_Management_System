<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'employee_id','type','start_date','end_date','days_count',
        'reason','status','reviewed_by','manager_comment','reviewed_at',
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function employee() { return $this->belongsTo(Employee::class); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewed_by'); }
}