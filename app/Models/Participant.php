<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_no',
        'name_en',
        'name_bn',
        'event_id',
        'class',
        'inst_name',
        'inst_address',
        'dob',
        'email',
        'phone',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

}
