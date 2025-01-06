<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mange1 extends Model
{
    use HasFactory;
    protected $table = "mange1";
    protected $primaryKey = "iddescriptioncommande";
    public $timestamps = false;
    public $guarded = [];
}
