<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'demande_id','nombre'];

    public function demande()
    {
        return $this->belongsTo('App\Models\Demande');
    }

    public function payement()
    {
        return $this->hasMany('App\Models\Payement');
    }
}
