<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class showTimes extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'from' => 'datetime:H:i',
        'to' => 'datetime:H:i',
    ];
}
