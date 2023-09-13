<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'participant_id',
        'event_id',
        'score',
        'absent',
        'user_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
