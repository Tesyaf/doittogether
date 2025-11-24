<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Task extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'team_id', 'category_id', 'title', 'description',
        'due_at', 'status', 'completed_at',
        'created_by_member_id', 'responsible_member_id',
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // RELATIONS
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(TeamMember::class, 'created_by_member_id');
    }

    public function responsible()
    {
        return $this->belongsTo(TeamMember::class, 'responsible_member_id');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(TeamMember::class, 'task_assignees', 'task_id', 'member_id')
                    ->withPivot('role_on_task');
    }
}
