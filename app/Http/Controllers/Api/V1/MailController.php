<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Mail\FormSubmission;
//use App\Mail\FormBlog;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {

      
      $formData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        // Envoi de l'email
       // try {
            Mail::to('evenement@wadounnou.com')->send(new FormSubmission($formData));
            return response()->json(['message' => 'Email envoyé avec succès.'], 200);
        //} catch (\Exception $e) {
         //   return response()->json(['message' => $e], 500);
       // }

      
    }
  
  	
}
