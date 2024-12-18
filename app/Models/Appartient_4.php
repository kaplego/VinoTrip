<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartient_4 extends Model
{
    use HasFactory;
    protected $table = "appartient_4";
    protected $primaryKey = ["idetape", "idactivite"];
    public $timestamps = false;
}
