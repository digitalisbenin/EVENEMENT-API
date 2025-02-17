<?php

use App\Http\Livewire\ShowRoles;
use App\Http\Livewire\ShowTemoignage;
use App\Http\Livewire\ShowUsers;
use App\Http\Livewire\ShowSpecialite;
use App\Http\Livewire\ShowPublicite;
use App\Http\Livewire\ShowCommentaires;
use App\Http\Livewire\ShowDemande;
use App\Http\Livewire\ShowDemandes;
use App\Http\Livewire\ShowUpdateDamande;
use App\Http\Livewire\ShowPartenaires;
use App\Http\Livewire\ShowUpdatePublicite;
use App\Http\Livewire\ShowUpdatePartenaire;
use App\Http\Livewire\ShowUpdateCommentaire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/show-roles', ShowRoles::class)->name('show-roles');
    Route::get('/show-partenaires', ShowPartenaires::class)->name('show-partenaires');
    Route::get('/show-demande-update/{id}', ShowUpdateDamande::class)->name('demandes');
    Route::get('/show-create-demande', ShowDemandes::class)->name('show-create-demande');
    Route::get('/show-users', ShowUsers::class)->name('show-users');
    Route::get('/show-publicites', ShowPublicite::class)->name('show-publicites');
    Route::get('/show-publicite-update/{id}', ShowUpdatePublicite::class)->name('publicites');
    Route::get('/show-partenaire-update/{id}', ShowUpdatePartenaire::class)->name('partenaire');
    Route::get('/show-commentaire-update/{id}', ShowUpdateCommentaire::class)->name('commentaire');
    Route::get('/show-temoignage', ShowTemoignage::class)->name('show-temoignage');
    Route::get('/show-typedemande', ShowSpecialite::class)->name('show-typedemande');
    Route::get('/show-commentaires', ShowCommentaires::class)->name('show-commentaires');
    Route::get('/show-demandes', ShowDemande::class)->name('show-demandes');
});
