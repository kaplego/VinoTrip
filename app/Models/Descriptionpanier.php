<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * N'UTILISEZ CETTE CLASSE QUE POUR DES INSERT/UPDATE/DELETE !!
 */

class Descriptionpanier extends Model
{
    use HasFactory;

    protected $table = "descriptionpanier";
    protected $primaryKey = "iddescriptionpanier";
    public $timestamps = false;
    public $guarded = [];
}
