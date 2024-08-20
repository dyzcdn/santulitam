<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cofasilitator extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'name',
        'nim',
        'email',
        'phone',
        'user_id',
    ];
}
