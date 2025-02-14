<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

     protected $fillable = ['content', 'demande_id', 'user_id'];

     
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    
    public function demande()
    {
        return $this->belongsTo('App\Models\Demande');
    }
}
