<?php

namespace App\Models;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'name',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
