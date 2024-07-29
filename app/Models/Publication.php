<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'video', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
