<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'price_per_person',
        'popularity',
        'image_path'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price_per_person' => 'decimal:2'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function recommendedActivities()
    {
        return $this->belongsToMany(
            Activity::class,
            'activity_recommendations',
            'activity_id',
            'recommended_id'
        );
    }

    public function recommendedByActivities()
    {
        return $this->belongsToMany(
            Activity::class,
            'activity_recommendations',
            'recommended_id',
            'activity_id'
        );
    }
}
