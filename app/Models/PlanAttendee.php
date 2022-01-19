<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAttendee extends Model
{
    use HasFactory;

    protected $table = 'plans_attendees';

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getStatusAttribute($value)
    {
        $status_types = [
            '' => 'N/A',
            'A' => 'Attending',
            'N' => 'Not Attending',
            'M' => 'Maybe',
        ];

        return $status_types[$value];
    }
}
