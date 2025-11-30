<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'opa_id',
        'borrow_date',
        'return_date',
        'status',
        'quantity',
        'notes',
        'loan_document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opa()
    {
        return $this->belongsTo(Opa::class);
    }

    // public function details()
    // {
    //     return $this->hasMany(LoanDetail::class);
    // }

    public function details()
    {
        return $this->hasMany(LoanDetail::class, 'loan_id');
    }
}
