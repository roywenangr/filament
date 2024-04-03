<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'koordinator_id',
        'name',
        'desa',
        'rt',
        'rw',
        'nope',
    ];
    public function koordinator()
    {
        return $this->belongsTo(Koordinator::class,);
    }
}
