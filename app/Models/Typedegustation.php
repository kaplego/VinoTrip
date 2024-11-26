<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typedegustation extends Model
{
    use HasFactory;

    protected $table = "typedegustation";
    protected $primaryKey = "idtypedegustation";
    public $timestamps = false;
}
