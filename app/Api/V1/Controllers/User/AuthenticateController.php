<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 28.09.16
 * Time: 18:01
 */

namespace App\Api\V1\Controllers\User;

use App\Http\Controllers\Controller;
use App\Transformers\User\UserTransformer;
use Dingo\Api\Auth\Auth;
use Dingo\Api\Auth\Provider\JWT;
use Dingo\Api\Routing\Helpers;
use JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    use Helpers;

    public function __construct()
    {

        // Only apply to a subset of methods.
        $this->middleware('api.auth', ['only' => ['logout', 'authenticatedUser', 'getToken']]);
        $this->middleware('auth.basic', ['only' => ['authenticatedUser']]);
    }

    /**
     *  API Login, on success return JWT Auth token
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->response->errorUnauthorized('invalid_credentials');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $this->response->errorInternal('could_not_create_token');
        }
        // all good so return the token
        return $this->response->array(['token' => $token]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     */
    public function logout()
    {
        JWTAuth::parseToken()->invalidate();
    }
    /**
     * Returns the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $this->response->errorNotFound('user_not_found');
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return $this->response->item($user, new UserTransformer);
    }
    /**
     * Refresh the token
     *
     * @return mixed
     */
    public function getToken()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            $this->response->errorInternal('Not able to refresh Token');
        }

        return $this->response->array(['token' => $refreshedToken]);
    }
}