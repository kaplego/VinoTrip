<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function authentification()
    {
      return view ("authentification", ['clients'=>Client::all()]);
    }

    private function compte($id)
    {
      return view ("compte", ['clients'=>Client::findOrFail($id)]);
    }

}
