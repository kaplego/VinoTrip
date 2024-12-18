<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesitue extends Model
{
    use HasFactory;

    protected $table = "se_situe";
    protected $primaryKey = ["idlocalite", "idsejour"];
    public $timestamps = false;
}
