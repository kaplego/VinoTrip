<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view("welcome");
    }
    public function mentions()
    {
        return view("mentions-legales");
    }
    public function politique()
    {
        return view("politique");
    }
    public function contact()
    {
        return view("contact");
    }
    public function conditions()
    {
        return view("conditions-vente");
    }

}
