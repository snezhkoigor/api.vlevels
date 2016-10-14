<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 13.10.16
 * Time: 17:02
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

        $response = $next($request)
            ->header('Access-Control-Allow-Origin: *')
            ->header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization')
            ->header('Access-Control-Allow-Credentials: true');

        if ($request->getMethod() == 'OPTIONS' && $response->getStatusCode() == 405) {
            return new Response('', 204, $response->headers->all());
        }

        return $response;
//
//        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//            header( "HTTP/1.1 200 OK" );
//        }
//
//        return $next($request);
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin');
    }
}