<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'message_id'];

    public function message()
    {
        return $this->belongsTo('App\Models\Message');
    }
}
