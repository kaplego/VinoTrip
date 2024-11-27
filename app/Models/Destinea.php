<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinea extends Model
{
    use HasFactory;

    protected $table = "destine_a";
    protected $primaryKey = ["idcategorieparticipant", "idsejour"];
    public $timestamps = false;
}
