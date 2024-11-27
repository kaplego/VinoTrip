<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function mentions()
    {
        return view("mentions-legales");
    }
}
