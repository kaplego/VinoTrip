<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = "partenaire";
    protected $primaryKey = "idpartenaire";
    public $timestamps = false;
}
