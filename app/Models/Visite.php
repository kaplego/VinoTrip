<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $table = "visite";
    protected $primaryKey = "idvisite";
    public $timestamps = false;
}
