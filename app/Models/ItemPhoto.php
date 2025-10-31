<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'item_id',
        'photo_path'
    ];

    protected static function booted()
    {
        static::deleting(function ($photo) {
            if ($photo->photo_path && Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
            }
        });
    }


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
