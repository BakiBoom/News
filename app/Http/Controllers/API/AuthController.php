<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\AuthModel;
use Validator;

class AuthController extends BaseController
{
    public function __construct() {
        $this->middleware('auth:api')->except('login');
    }

    public function registartion (Request $request) {
        $input = $request->only(['email', 'password', 'name']);
    }

    public function login(Request $request) {
        $input = $request->only(['email', 'password']);
        $token = auth('api')->attempt($input);
        if(!$token) {
            $this->sendError('Unautorization', [], 401);
        }
        $this->sendResponse($this->respondWithToken($token), 'Successfully login');
    }

    public function logout(Request $request) {
        auth('api')->logout();
        return $this->sendResponse([], 'Successfully login');
    }

    public function refresh(Request $request) {
        return $this->respondWithToken(auth('api')->refresh());
    }

    private function respondWithToken($token) {
        return new AuthModel($token, 'Bearer', \Config::get('jwt.ttl') * 60);
    }
}
