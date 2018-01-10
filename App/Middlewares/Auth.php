<?php

namespace App\Middlewares;
use App\Core\Middleware;

class Auth extends Middleware
{

    public function Verification() {
        return true;
    }

    public function Redirect() {
        // TODO: Implement Redirect() method.
    }

}