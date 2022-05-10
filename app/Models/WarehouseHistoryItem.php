<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseHistoryItem extends Model
{
    use HasFactory;

    //protected $fillable = ['id'];
    protected $guarded = ['id'];
    //protected $casts = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
