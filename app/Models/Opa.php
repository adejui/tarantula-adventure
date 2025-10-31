<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opa extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'organization_name',
        'campus_name',
        'phone_number',
        'address',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
