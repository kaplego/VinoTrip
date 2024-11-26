<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typecuisine extends Model
{
    use HasFactory;

    protected $table = "typecuisine";
    protected $primaryKey = "idtypecuisine";
    public $timestamps = false;
}
