<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'required_quantity',
        'unit',
    ];

    protected $casts = [
        'required_quantity' => 'decimal:2',
    ];

    public function pledges(): HasMany
    {
        return $this->hasMany(Pledge::class);
    }

    /**
     * Get the total pledged quantity for this item.
     */
    public function getTotalPledgedAttribute(): float
    {
        return (float) DB::table('pledge_items')
            ->where('item_id', $this->id)
            ->sum('pledged_quantity');
    }

    /**
     * Get the remaining quantity needed.
     */
    public function getRemainingQuantityAttribute(): float
    {
        if ($this->required_quantity === null) {
            return 0;
        }
        return max(0, (float) $this->required_quantity - $this->total_pledged);
    }

    /**
     * Get the fulfillment percentage (0–100).
     */
    public function getFulfillmentPercentageAttribute(): float
    {
        if ($this->required_quantity === null || (float) $this->required_quantity <= 0) {
            return 0;
        }

        return min(100, round(($this->total_pledged / (float) $this->required_quantity) * 100, 1));
    }
}
