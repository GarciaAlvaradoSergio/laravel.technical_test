<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'people',
        'booking_price',
        'booking_date',
        'activity_date',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
