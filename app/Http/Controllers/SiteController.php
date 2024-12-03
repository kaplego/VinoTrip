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
        return view("legal.mentions-legales");
    }
    public function politique()
    {
        return view("legal.politique");
    }
    public function contact()
    {
        return view("contact");
    }
    public function conditions()
    {
        return view("legal.conditions-vente");
    }

}
