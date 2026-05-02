<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id', 'date', 'time_in', 'time_out', 'status', 'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getHoursWorkedAttribute()
    {
       
        if ($this->time_in && $this->time_out) {
            $in  = Carbon::parse('2000-01-01 ' . $this->time_in);
            $out = Carbon::parse('2000-01-01 ' . $this->time_out);

            // Handle overnight shifts
            if ($out->lt($in)) {
                $out->addDay();
            }

            $minutes = $in->diffInMinutes($out);
            return round($minutes / 60, 2);
        }
        return 0;
    }
}