<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TeamInvitation extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'team_id', 'email', 'code', 'invited_by_member', 'status', 'expires_at'
    ];

    protected $casts = [
        'email' => 'encrypted',
        'code' => 'encrypted',
        'expires_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function inviter()
    {
        return $this->belongsTo(TeamMember::class, 'invited_by_member');
    }
}
