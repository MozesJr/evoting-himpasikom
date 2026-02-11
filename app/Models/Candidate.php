<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'nama',
        'foto',
        'visi',
        'misi',
        'nomor_urut'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
