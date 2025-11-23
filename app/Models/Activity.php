<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'activity_type',
        'color',
        'start_date',
        'end_date',
        'location',
        'description',
    ];

    public function members()
    {
        return $this->hasMany(ActivityMember::class);
    }

    public function documentations()
    {
        return $this->hasMany(ActivityDocument::class);
    }

    public function activity_photos()
    {
        return $this->hasMany(ActivityPhoto::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
