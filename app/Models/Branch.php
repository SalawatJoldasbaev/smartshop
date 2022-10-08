<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'is_main',
    ];
    //protected $guarded = ['id'];
    protected $casts = [
        'is_main' => 'boolean',
    ];
}
