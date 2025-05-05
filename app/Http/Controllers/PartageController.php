<?php

namespace App\Http\Controllers;

use App\Models\Demande;

class PartageController extends Controller
{
    public function show($id)
    {
        $demande = Demande::findOrFail($id);
        return view('partage', compact('demande'));
    }
}

