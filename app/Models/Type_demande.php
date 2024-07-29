<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_demande extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function demande()
    {
        return $this->hasMany('App\Models\Demande');
    }
}
