<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bids()
    {
        return $this->hasMany(AuctionBid::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class);
    }
}
