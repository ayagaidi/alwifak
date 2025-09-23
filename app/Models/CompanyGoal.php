<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyGoal extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
