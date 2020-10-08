<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisUserRequest;
use App\Models\User;

class UserController extends Controller {
    public function registry(RegisUserRequest $request) {
        $data = $request->validated();
        $user = User::query()->create($data);
        return responder()->success($user)->respond();
    }
}
