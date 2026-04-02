<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'exam_type_id',
        'name',
        'duration_minutes',
        'price',
    ];


    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
