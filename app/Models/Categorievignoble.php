<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorievignoble extends Model
{
    use HasFactory;

    protected $table = "categorievignoble";
    protected $primaryKey = "idcategorievignoble";
    public $timestamps = false;
}
