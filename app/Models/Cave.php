<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cave extends Model
{
    use HasFactory;

    protected $table = "cave";
    protected $primaryKey = "idpartenaire";
    public $timestamps = false;
}
