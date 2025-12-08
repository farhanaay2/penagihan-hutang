<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debt;
use App\Models\Payment;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'note'
    ];

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            Debt::class,
            'customer_id',
            'debt_id',
            'id',
            'id'
        );
    }
}
