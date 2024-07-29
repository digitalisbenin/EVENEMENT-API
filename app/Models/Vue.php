<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vue extends Model
{
    use HasFactory;

    protected $fillable = ['vue', 'demande_id'];

    public function demande()
    {
        return $this->belongsTo('App\Models\Demande');
    }
}
