<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityPhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'activity_id',
        'photo_path',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
