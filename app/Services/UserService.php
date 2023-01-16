<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserService {

    /**
     * @param $data
     * @return mixed
     */
    public function store($data): mixed
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::query()->create($data);
        return $user->createToken('Access Token')->plainTextToken;
    }

    /**
     * @param $request
     * @return Application|ResponseFactory|Response
     */
    public function login($request) {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response('Login invalid', 503);
        }

        return $user->createToken('Access Token')->plainTextToken;
    }

    public function index($data) {
        $token =  PersonalAccessToken::findToken($data['token']);
        $user = $token->tokenable;
    }
}
