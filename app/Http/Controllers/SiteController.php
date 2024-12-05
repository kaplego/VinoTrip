<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Etape;
use App\Models\Sejour;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view("welcome", [
            'listeSejour' => Sejour::limit(5)->get(),


        ]);
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
    public function destinations()
    {
        return view("destinations");
    }

}
