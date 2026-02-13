<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'voting_open',
        'voting_start',
        'voting_end'
    ];

    protected $casts = [
        'voting_start' => 'datetime',
        'voting_end' => 'datetime',
    ];
}
