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
        'email',
        'phone',
        'peleton_id'
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
