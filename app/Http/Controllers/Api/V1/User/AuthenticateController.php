<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 28.09.16
 * Time: 18:01
 */

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Transformers\User\UserTransformer;
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
//        $this->middleware('auth.basic', ['only' => ['authenticatedUser']]);
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
        $token = null;
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->response->errorUnauthorized(json_encode(['System' => ['Invalid credentials.']]));
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $this->response->errorBadRequest(json_encode(['System' => ['Could not create token.']]));
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
                $this->response->errorBadRequest(json_encode(['System' => ['User not found.']]));
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return $this->response->array(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->response->array(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return $this->response->array(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return $this->response->item($user, new UserTransformer);
    }

    public function isAuthenticated()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $this->response->array(['isAuthenticated' => false]);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return $this->response->array(['isAuthenticated' => false]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->response->array(['isAuthenticated' => false]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return $this->response->array(['isAuthenticated' => false]);
        }

        // the token is valid and we have found the user via the sub claim
        return $this->response->array(['isAuthenticated' => true]);
    }

    /**
     * Refresh the token
     *
     * @return mixed
     */
    public function getToken()
    {
        $refreshedToken = null;
        $token = JWTAuth::getToken();

        if (!$token) {
            $this->response->errorMethodNotAllowed(json_encode(['System' => ['Token not provided.']]));
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            $this->response->errorBadRequest(json_encode(['System' => ['Not able to refresh Token.']]));
        }

        return $this->response->array(['token' => $refreshedToken]);
    }
}