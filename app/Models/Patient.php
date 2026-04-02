<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_kana',
        'birth_date',
        'gender',
        'phone',
        'email',
        'allergy_notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
