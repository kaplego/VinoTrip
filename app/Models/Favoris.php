<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    use HasFactory;
    protected $table = "favoris";
    protected $primaryKey = ["idclient", "idsejour"];
    public $timestamps = false;
}
