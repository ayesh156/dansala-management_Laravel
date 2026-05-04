<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pledge extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_address',
        'donor_mobile',
    ];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'pledge_items')
            ->withPivot('pledged_quantity')
            ->withTimestamps();
    }
}
