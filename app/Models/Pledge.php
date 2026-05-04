<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pledge extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'donor_name',
        'donor_address',
        'donor_mobile',
        'pledged_quantity',
    ];

    protected $casts = [
        'pledged_quantity' => 'decimal:2',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
