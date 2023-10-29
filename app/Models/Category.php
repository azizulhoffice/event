<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','is_optional'];
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function unpublishedEvents()
    {
        return $this->hasMany(Event::class)->where('result_published',0);
    }
}
