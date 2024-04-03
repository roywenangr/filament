<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desa',
        'nope',
    ];
    public function relawan()
    {
        return $this->hasMany(Relawan::class);
    }
}
