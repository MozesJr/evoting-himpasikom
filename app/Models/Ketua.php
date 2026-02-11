<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ketua extends Model
{
    protected $fillable = [
        'nama',
        'foto',
        'visi',
        'misi',
        'periode',
        'keterangan'
    ];
}
