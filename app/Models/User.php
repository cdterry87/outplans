<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Friend;
use App\Models\Message;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['created_at'];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function isMe()
    {
        return auth()->user()->id === $this->id;
    }

    public function isProfilePrivate()
    {
        return false; //Needs to be implemented with a private field in the users table
    }

    public function plans_upcoming()
    {
        return $this->hasMany(Plan::class)
            ->where('plans.when', '>=', Carbon::now())
            ->orderBy('when');
    }

    public function plans_invites_sent()
    {
        return DB::table('plans')
            ->select(
                'plans.*',
                'plans_invites.invited_user_id',
                'users.name as sent_to'
            )
            ->join('plans_invites', 'plans_invites.plan_id', '=', 'plans.id')
            ->join('users', 'users.id', '=', 'plans_invites.invited_user_id')
            ->where('plans_invites.user_id', '=', auth()->user()->id)
            ->orderBy('start_datetime');
    }

    public function plans_invited()
    {
        return $this->belongsToMany(Plan::class, 'plans_invites', 'invited_user_id', 'plan_id')
            ->select(
                'plans.*',
                'users.name as invited_by',
                'plans_invites.user_id',
            )
            ->join('users', 'users.id', '=', 'plans_invites.user_id');
    }

    public function plans_attended()
    {
        return DB::table('plans')
            ->select(
                'plans.*',
                'plans_attendees.status'
            )
            ->join('plans_attendees', 'plans_attendees.plan_id', '=', 'plans.id')
            ->where('plans_attendees.status', '=', 'A')
            ->where('plans_attendees.user_id', '=', auth()->user()->id)
            ->where('plans.published', '!=', null)
            ->where('plans.when', '<', Carbon::now())
            ->orderBy('plans.when', 'desc');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function friends_requests()
    {
        return DB::table('friends_requests')
            ->where('requested_user_id', '=', auth()->user()->id);
    }

    public function friends_with_details()
    {
        return DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'friends.created_at as friended_at',
            )
            ->join('friends', 'friends.friend_user_id', 'users.id')
            ->where('friends.user_id', '=', auth()->user()->id);
    }

    public function uninvited_friends_with_details()
    {
    }

    public function friends_requests_sent_with_details()
    {
        return DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'friends_requests.created_at'
            )
            ->join('friends_requests', 'friends_requests.requested_user_id', 'users.id')
            ->where('friends_requests.user_id', '=', auth()->user()->id);
    }

    public function friends_requests_received_with_details()
    {
        return DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'friends_requests.created_at'
            )
            ->join('friends_requests', 'friends_requests.user_id', 'users.id')
            ->where('friends_requests.requested_user_id', '=', auth()->user()->id);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getPublicPlans()
    {
        return $this->plans()
            ->where('published', '!=', null)
            ->where('start_datetime', '>=', Carbon::now())
            ->where(function ($query) {
                // Get only the plans set to 'P' for Public 
                $query->where('privacy', 'P');
                // or get plans of friends that are set to 'F' for Friends Only
                $query->orWhere(function ($subquery) {
                    $subquery->where('privacy', 'F');
                    $subquery->whereIn('user_id', Friend::select('friend_user_id')->where('user_id', auth()->id()));
                });
            })
            ->orderBy('start_datetime')
            ->get();
    }

    public function isFriend()
    {
        return Friend::where('user_id', auth()->user()->id)
            ->where('friend_user_id', $this->id)
            ->exists();
    }
}
