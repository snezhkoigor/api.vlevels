<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 13.10.16
 * Time: 17:02
 */

namespace App\Http\Middleware;

use Closure;

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
        header("Access-Control-Allow-Origin: *");
//        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//        header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type, X-Auth-Token, Origin, Authorization");

        return $next($request);
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin');
    }
}