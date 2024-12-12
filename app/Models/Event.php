<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'duration',
        'id_age_restriction',
        'description',
        'team',
        'image',
        'show_date',
    ];

    public function ageRestriction()
    {
        return $this->belongsTo(AgeRegistration::class, 'id_age_restriction');
    }

    public function getShowDateAttribute($value)
    {
        return new \DateTime($value);
    }
}
