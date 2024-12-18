<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartient_1 extends Model
{
    use HasFactory;
    protected $table = "appartient_1";
    protected $primaryKey = ["idetape", "idvisite"];
    public $timestamps = false;
}
