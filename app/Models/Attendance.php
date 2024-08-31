<?php

namespace App\Models;

use App\Models\Theme;
use App\Models\Peleton;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'theme_id',
        'peleton_id',
        'check_in',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function peleton()
    {
        return $this->belongsTo(Peleton::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->check_in)) {
                $model->check_in = now();
            }
        });
    }
}
