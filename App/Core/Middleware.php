<?php

namespace App\Core;


abstract class Middleware
{

    public function __construct() {
    }

    abstract public function Verification();

    abstract public function Redirect();

}