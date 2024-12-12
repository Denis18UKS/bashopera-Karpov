<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['tvalue'];

    public function events()
    {
        return $this->hasMany(Event::class, 'id_age_restriction');
    }
}
