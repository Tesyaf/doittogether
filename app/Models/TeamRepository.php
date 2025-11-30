<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TeamRepository extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_id',
        'provider',
        'repo_full_name',
        'branch',
        'webhook_secret',
    ];

    protected $casts = [
        'team_id' => 'string',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function commits()
    {
        return $this->hasMany(RepositoryCommit::class);
    }
}
