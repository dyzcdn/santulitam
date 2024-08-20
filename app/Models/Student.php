<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'image',
        'major_id',
        'peleton_id',
        'email',
        'phone'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function peleton()
    {
        return $this->belongsTo(Peleton::class);
    }
}
