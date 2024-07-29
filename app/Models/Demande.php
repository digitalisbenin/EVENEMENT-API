<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    
    protected $fillable = ['name', 'description', 'date_debuit','date_fin', 'lieu', 'image','video', 'montant', 'nombre_jour','status', 'user_id', 'type_demande_id','is_correct','telephone'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function type_demande()
    {
        return $this->belongsTo('App\Models\Type_demande');
    }
    
    public function commentaire()
    {
        return $this->hasMany('App\Models\Commentaire');
    }
    
    public function vue()
    {
        return $this->hasMany('App\Models\Vue');
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function signaler()
    {
        return $this->hasMany('App\Models\Signaler');
    }

    public function payement()
    {
        return $this->hasMany('App\Models\Payement');
    }
}
