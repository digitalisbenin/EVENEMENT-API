<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [ 'montant', 'tickets_id', 'user_id','demande_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    public function demande()
    {
        return $this->belongsTo('App\Models\Demande');
    }

    public function trasaction()
    {
        return $this->hasMany('App\Models\Transation');
    }
}
