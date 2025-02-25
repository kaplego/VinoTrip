<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Activite extends Model
{
    use HasFactory;

    protected $table = "activite";
    protected $primaryKey = "idactivite";
    public $timestamps = false;
}
