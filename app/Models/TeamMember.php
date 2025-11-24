<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TeamMember extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'team_members';
    protected $primaryKey = 'id_member';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'team_id',
        'user_id',
        'role',
        'joined_at',
    ];

    // RELATIONS
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by_member_id');
    }

    public function responsibleTasks()
    {
        return $this->hasMany(Task::class, 'responsible_member_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'actor_member_id');
    }
}
