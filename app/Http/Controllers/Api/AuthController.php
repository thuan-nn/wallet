<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    /**
     * @param UserLoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     */
    public function login(UserLoginRequest $request) {
        $data = $request->validated();
        $email = Arr::get($data, 'email');
        $password = Arr::get($data, 'password');
        $user = User::query()->where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException();
        }

        $token = $user->createToken('Token');

        return response()->json([
                                    'status'     => 200,
                                    'token'      => $token->accessToken,
                                    'expires_at' => $token->token->expires_at
                                ]);
    }

    public function logout(Request $request) {
        $request->user('api')->revoke();

        return responder()->success();
    }

    public function me(Request $request) {
        $user = $request->user('api');

        return responder()->success($user, UserTransformer::class)->respond();
    }
}
