<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','category_id','group_id','description','event_dateTime','last_position','org_name','occation'
    ];

    protected $casts = [
        "event_dateTime" => "datetime",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function participants() {
        return $this->hasMany(Participant::class)->orderBy('serial_no');
    }

    public function scores() {
        return $this->hasMany(Score::class)->where('user_id',Auth::id());
    }
    public function allScores() {
        return $this->hasMany(Score::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
