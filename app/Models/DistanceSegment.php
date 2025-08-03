<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DistanceSegment extends Model
{
      use HasFactory;

    protected $fillable = [
        'ticket_id',
        'from_location',
        'waypoint',
    ];

    /**
     * Get the ticket that owns the distance segment.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
