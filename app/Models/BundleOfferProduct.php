<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleOfferProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'bundle_offer_id',
        'product_id',
        'product_variant_id',
    ];

    /**
     * Get the bundle offer that this product belongs to.
     */
    public function bundleOffer()
    {
        return $this->belongsTo(BundleOffer::class);
    }

    /**
     * Get the product associated with this entry (if it's not a variant).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product variant associated with this entry.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
