<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_member_id', 'action', 'entity_type', 'entity_id', 'meta'
    ];

    public function actor()
    {
        return $this->belongsTo(TeamMember::class, 'actor_member_id');
    }
}
