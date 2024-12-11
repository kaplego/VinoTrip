<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selocalise extends Model
{
    use HasFactory;
    protected $table = "se_localise";
    protected $primaryKey = ["idroute", "idcategorievignoble"];
    public $timestamps = false;
}
