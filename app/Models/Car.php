<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'año',
        'color',
        'precio',
        'kilometraje',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
