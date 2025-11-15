<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'quantity',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }

    public function photos()
    {
        return $this->hasMany(ItemPhoto::class);
    }

    public function getPhotoAttribute()
    {
        return $this->photos()->orderBy('id', 'asc')->first()?->photo_path;
    }
}
