<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_mobile',
        'donor_address',
        'amount',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
