<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Team extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'team_code',
        'created_by',
    ];

    protected $casts = [
        'team_code' => 'encrypted',
    ];

    // OWNER
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // MEMBERS (pivot detail)
    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }

    // USERS (pivot belongsToMany)
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_members', 'team_id', 'user_id')
                    ->withPivot('id_member', 'role', 'joined_at');
    }

    // CATEGORIES
    public function categories()
    {
        return $this->hasMany(Category::class, 'team_id');
    }

    // TASKS
    public function tasks()
    {
        return $this->hasMany(Task::class, 'team_id');
    }

    // INVITATIONS
    public function invitations()
    {
        return $this->hasMany(TeamInvitation::class, 'team_id');
    }
}
