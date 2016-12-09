<?php
/**
 * Created by PhpStorm.
 * User: igorsnezko
 * Date: 09.12.16
 * Time: 17:44
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |

    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => true,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'X-Auth-Token', 'Origin', 'X-Requested-With', 'Accept', 'Authorization'], // ex : ['Content-Type', 'Accept']
    'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 0,
    'hosts' => [],
];