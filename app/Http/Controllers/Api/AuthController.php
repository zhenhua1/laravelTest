<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $authRequest=new AuthRequest();
        $validator=\Validator::make($credentials,$authRequest->rules(),$authRequest->messages());
        if(!is_null($msg=$this->validateCheck($validator))) return $this->error($msg);
        $token=\JWTAuth::attempt($credentials);
        if(!$token) return $this->error('未经授权');
        return $this->respondWithToken($token);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function getUser()
    {
        if(\JWTAuth::parseToken()->check()){
            $user=\JWTAuth::parseToken()->authenticate();
            return $this->success($user,'成功');
        }
        return $this->error('登录已失效请重新登陆');
    }

    /**
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function logout()
    {
        \JWTAuth::parseToken()->invalidate();
        return $this->success([],'退出成功');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function refresh()
    {
        return $this->respondWithToken(\JWTAuth::parseToken()->refresh());
    }

    public function respondWithToken($token)
    {
        $data=[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \JWTAuth::factory()->getTTL()
        ];
        return $this->success($data,'成功');
    }
}
