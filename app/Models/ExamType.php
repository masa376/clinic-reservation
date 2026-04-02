<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'preparation_notes',
    ];


    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
