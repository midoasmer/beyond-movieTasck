<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts = [
        'day' => 'date:Y-m-d',
    ];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function showtime(){
        return $this->belongsTo(showTimes::class,'show_times_id');
    }
}
