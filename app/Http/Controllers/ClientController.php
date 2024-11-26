<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function view($id)
    {
      return view ("client-info", ['client'=>Client::findOrFail($id) ]);
    }

}
