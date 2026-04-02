<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'staff_id',
        'menu_id',
        'reserved_at',
        'status',
        'memo',
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
