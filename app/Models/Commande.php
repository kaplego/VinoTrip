<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * N'UTILISEZ CETTE CLASSE QUE POUR DES INSERT/UPDATE/DELETE !!
 */

class Commande extends Model
{
    use HasFactory;

    protected $table = "commande";
    protected $primaryKey = "idcommande";
    public $timestamps = false;
    public $guarded = [];

}
