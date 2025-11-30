<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RepositoryCommit extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_repository_id',
        'sha',
        'message',
        'author_name',
        'author_email',
        'branch',
        'committed_at',
        'html_url',
        'payload',
    ];

    protected $casts = [
        'committed_at' => 'datetime',
        'payload' => 'array',
    ];

    public function repository()
    {
        return $this->belongsTo(TeamRepository::class, 'team_repository_id');
    }
}
