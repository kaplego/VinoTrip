<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriesejour extends Model
{
    use HasFactory;

    protected $table = "categoriesejour";
    protected $primaryKey = "idcategoriesejour";
    public $timestamps = false;
}
