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

    protected $dates = ['when'];

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

    public function getWhenAttribute($value)
    {
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function getFullAddress()
    {
        return $this->address . ' ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code;
    }

    public function getDisplayImage()
    {
        return asset('storage/' . $this->image) ?? null;
    }
}
