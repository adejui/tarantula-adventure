<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityDocument extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'activity_documentations';
    protected $fillable = [
        'activity_id',
        'photo_path',
        'google_drive_link',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
