<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTaskPriority extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'label', 'color', 'weight', 'is_default'];
}
