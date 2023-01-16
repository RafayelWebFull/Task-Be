<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\User\GetUserRequest;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Http\Requests\Api\User\UserGetRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    /**
     * @param Request $request
     * @return void
     */
    public function index(UserGetRequest $request) {
        $this->service->index($request->validated());
        return $user;
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $token = $this->service->store($request->validated());

        return response()->json($token);
    }

    /**
     * @param LoginRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function login(LoginRequest $request) {
        return $this->service->login($request);
    }
}
