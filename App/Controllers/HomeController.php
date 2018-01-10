<?php

namespace App\Controllers;
use App\Core\Controller;


class HomeController extends Controller
{
    public function Index($data) {
        return view('home', $data);
    }
}