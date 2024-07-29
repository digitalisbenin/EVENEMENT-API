<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Auth\EmailVerificationOrResetRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class VerificationController extends ApiController
{
    /**
     * Verify email adress
     *
     *
     * @urlParam user string required The id of the user Example: 15164458-3bdf-4a3c-b96a-82b817a017dd
     * @urlParam signature string required The signature sent in the email Example:  e7b16953405106e78d1e56e9110517fed94be45ec93b870a7b2eb55d8baacb73
     * @urlParam expires string required The expires time duration Example: 1675935864
     * @return JsonResponse
     *
     * @response scenario=success status=200 {
     *  "status": "verified'"
     * }
     *
     *  * @response scenario=success status=200 {
     *  "success":true,
     *  "message": "Verification sent",
     *  "data": [
     *      "Clear description"
     *  ]
     * }
     *  * @response scenario=success status=422 {
     *   "success":false,
     *  "message": "Email sending failed",
     *  "data": [
     *      "Clear description"
     *  ]
     * }
     * }
     * @throws Exception
     */
    public function verify(Request $request, User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => trans('operation_failed'),
                'data' => [
                    trans('messages.already_verified')
                ]
            ], 200);
        }

        $user->markEmailAsVerified();
        $user->update(["is_verified" => true]);

        $user->save();


        event(new Verified($user));

        $tokenResult = $user->createToken(Str::random(15));

        return $this->respondWithToken($tokenResult);
    }

    public function resend(EmailVerificationOrResetRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (is_null($user)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => trans('messages.operation_failed'),
                'data' => [
                    trans('messages.not.found')
                ]
            ], 400));
        }

        if ($user->hasVerifiedEmail()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => trans('messages.operation_failed', [], $user->local),
                'data' => [
                    trans('messages.already_verified', [], $user->local)
                ]
            ], 422));
        }

        $user->sendEmailVerificationNotification();
        return response()->json([
            'success' => true,
            'message' => trans('messages.successfully_operated', [], $user->local),
            'data' => [
                trans('messages.verification_sent', [], $user->local)
            ]
        ]);
    }
}
