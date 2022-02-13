<?php

namespace App\Models;

use App\Models\PlanAttendee;
use App\Models\PlanInvite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['start_datetime', 'end_datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendees()
    {
        return $this->hasMany(PlanAttendee::class);
    }

    public function invites()
    {
        return $this->hasMany(PlanInvite::class);
    }

    public function isMine()
    {
        return auth()->user()->id === $this->user_id;
    }

    public function getPrivacyAttribute($value)
    {
        $privacy_types = [
            'F' => 'Friends Only',
            'I' => 'Invite Only',
            'P' => 'Public'
        ];

        return $privacy_types[$value];
    }

    public function getFormattedStartDateTime()
    {
        return Carbon::parse($this->start_datetime)->toDayDateTimeString();
    }

    public function getFormattedEndDateTime()
    {
        return Carbon::parse($this->end_datetime)->toDayDateTimeString();
    }

    public function getFormattedDateRange()
    {
        $range = $this->getFormattedStartDateTime();
        if ($this->end_datetime) {
            $range .= ' - ' . $this->getFormattedEndDateTime();
        }

        return $range;
    }

    public function getFullAddress()
    {
        return $this->address . ' ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code;
    }

    public function getDisplayImage()
    {
        return filter_var($this->image, FILTER_VALIDATE_URL)
            ? $this->image
            : asset('storage/' . $this->image) ?? null;
    }
}
