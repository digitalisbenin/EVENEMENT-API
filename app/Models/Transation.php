<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transation extends Model
{
    use HasFactory;

    protected $fillable = ['payement_id', 'transationId'];

    public function payement()
    {
        return $this->belongsTo('App\Models\Payement');
    }
}
