<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Tymon\JWTAuth\Providers\Auth\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class AuthController extends BaseController
{
    public function __construct() {
        $this->middleware('auth:api')->except(['login', 'registration', 'logout']);
    }

    public function registration (Request $request) {
        $input = $request->only(['email', 'password', 'name']);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        $token = auth('api')->login($user);
        return $this->sendResponse($this->respondWithToken($token), 'User registered successfully');
    }

    public function login(Request $request) {
        $input = $request->only(['email', 'password']);
        $token = auth('api')->attempt($input);
        if(!$token) {
            $this->sendError('Unautorization', [], 401);
        }
        return $this->sendResponse($this->respondWithToken($token), 'Successfully login');
    }

    public function logout(Request $request) {
        auth('api')->logout();
        return $this->sendResponse([], 'Successfully logout');
    }

    public function refresh(Request $request) {
        return $this->sendResponse($this->respondWithToken(auth('api')->refresh()), '');
    }

    private function respondWithToken($token) {
        return [
            'token' => $token,
            'type' => 'Bearer',
            'liveTime' => Config::get('jwt.ttl') * 60
        ];
    }
}
