<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendResetMessage;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ForgotPasswordController extends Controller
{
    /**
     * Send PasswordReset Link
     *
     * @unauthenticated
     *
     * @bodyParam  email string required The email of the user Example:  user@testourvoice.com
     *
     * @response scenario=success status=200 {
     *  "status": "email verification link sent to your mail"
     * }
     *
     * @response status=404 scenario="Not found response" {"message": "Email already verify or link is expired"}
     *
     * @return JsonResponse
     *
     *
     */
    protected function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => trans('messages.validation_errors'),
                'data' => $validator->errors()->all()
            ], 422));
        }
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.validation_errors'),
                'data' => [
                    trans("messages.not_found"),
                ]
            ], 400);
        } else {
            //if (!$user->hasVerifiedEmail()) {
            //    return response()->json([
              //      'success' => false,
                //    'message' => trans('messages.authorization_errors'),
                  //  'data' => [
                    //    trans('messages.email_not_verified'),
                    //]
               // ], 403);
            //}
            SendResetMessage::dispatch($user)->onQueue('emails');

            return response()->json([
                'success' => true,
                'message' => trans('messages.successfully_operated'),
                'data' => [
                    trans('messages.successfully_operated')
                ]
            ]);
        }
    }


    /**
     * Reset Password
     *
     * @unauthenticated
     *
     * @return JsonResponse
     *
     *
     * @bodyParam email string required The email of the user Example:  testourvoice@gmail.com
     * @bodyParam password string required The new password of the user Example:  password
     * @bodyParam password_confirmation string required The new password of the user Example:  password
     * @bodyParam token string required  The token sent to the mail Example:  dfnrknrnfjrenre
     *
     * @response scenario=success status=200 {
     *  'message' => 'Password reset successfully'
     * }
     *
     * @response status=404 scenario="Not found response" {"message": "Email already verify or link is expired"}
     *
     */
    protected function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => ['required', 'confirmed', RulesPassword::defaults()]
        ]);
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => trans('messages.validation_errors'),
                'data' => $validator->errors()->all()
            ], 422));
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                ])->setRememberToken(Str::random(60));

                $user->save();


                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => trans('messages.successfully_operated'),
                'data' => [
                    trans('messages.successfully_operated')
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('messages.operation_failed'),
            'data' => [
                trans(__($status))
            ]
        ], 422);
    }
}
