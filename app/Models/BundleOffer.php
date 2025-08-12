<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'status',
    ];

    /**
     * Get all of the tiers for the BundleOffer.
     */
    public function tiers()
    {
        return $this->hasMany(BundleOfferTier::class);
    }

    /**
     * Get all of the products for the BundleOffer.
     */
    public function products()
    {
        return $this->hasMany(BundleOfferProduct::class);
    }
}
