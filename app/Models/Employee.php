<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    //protected $fillable = ['id'];
    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
