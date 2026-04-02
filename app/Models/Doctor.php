<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'specialty',
        'phone',
        'email',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
