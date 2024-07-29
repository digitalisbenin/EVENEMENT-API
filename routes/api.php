<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\DemandeController;
use App\Http\Controllers\Api\V1\TemoinageController;
use App\Http\Controllers\Api\V1\PublicationController;
use App\Http\Controllers\Api\V1\VueController;
use App\Http\Controllers\Api\V1\CommentaireController;
use App\Http\Controllers\Api\V1\MailController;
use App\Http\Controllers\Api\V1\Type_demandeController;
use App\Http\Controllers\Api\V1\MediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('json-response')->prefix('auth')->group(function () {
    // route to register new user for the platform
    Route::post("/register", [AuthController::class, 'register'])->name('api.register');
    // route to log the user if he has already sign up
    Route::post("/login", [AuthController::class, 'login'])->name('api.login');
    // route to send reset link to email for password forgotten
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    // route to send reset password for password forgotten
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('passwords.reset');
    // route to resend the email verification when the link has expired
    Route::post('resend/', [VerificationController::class, 'resend'])->name('verification.resend');
    // route to verify email after clicking on the link on email
    Route::get('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify')
        ->middleware('signed');
});


Route::middleware(['auth:sanctum', 'json-response'])->group(function () {
    Route::get("logout", [AuthController::class, 'logout']);
    Route::post('/demandes', [DemandeController::class, 'store']);
  	Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    
});

Route::get('/demandes', [DemandeController::class, 'index']);
Route::get('/typedemandes', [Type_demandeController::class, 'index']);
Route::get('/demandes/{id}', [DemandeController::class, 'show']);
Route::get('/demandestype', [DemandeController::class, 'getDemandeType']);
Route::get('/temoingnages', [TemoinageController::class, 'index']);
Route::get('/publictes', [PublicationController::class, 'index']);
Route::post('/temoingnages', [TemoinageController::class, 'store']);
Route::post('/vues', [VueController::class, 'store']);
Route::post('/commentaires', [CommentaireController::class, 'store']);
Route::post('/sendemail', [MailController::class, 'sendEmail']);
Route::post('/medias', [MediaController::class, 'store']);