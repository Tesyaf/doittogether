<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TaskAttachment extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['task_id', 'member_id', 'file_name', 'file_url'];

    protected $casts = [
        'file_name' => 'encrypted',
        'file_url' => 'encrypted',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function member()
    {
        return $this->belongsTo(TeamMember::class, 'member_id');
    }
}
