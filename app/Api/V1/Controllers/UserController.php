<?php

namespace App\Api\V1\Controllers;

use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function show($id)
    {
        var_dump($id);
    }
}
