<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';

    protected $fillable = [
        'name',
        'role',
        'phone',
        'email',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
