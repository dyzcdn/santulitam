<?php

namespace App\Models;

use App\Models\Cofasilitator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peleton extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cofasilitator_id'
    ];

    public function cofasilitator()
    {
        return $this->belongsTo(Cofasilitator::class);
    }
}
