<?php

namespace App\Models;

use App\Models\Theme;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'theme_id',
        'check_in',
        'check_out',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
