<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autresociete extends Model
{
    use HasFactory;

    protected $table = "autresociete";
    protected $primaryKey = "idpartenaire";
    public $timestamps = false;
}
