<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routedesvins;

class RoutesVinsController extends Controller
{
    public function list()
    {
        return view('routedesvins.route-des-vins', ['routes' => Routedesvins::all() ]);
    }
    public function one($id)
    {
        return view ('routedesvins.summary', [
            'route'=>Routedesvins::find($id),
        ]);
    }
}
