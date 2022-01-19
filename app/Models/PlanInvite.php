<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanInvite extends Model
{
    use HasFactory;

    protected $table = 'plans_invites';

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
