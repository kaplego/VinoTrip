<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * N'UTILISEZ CETTE CLASSE QUE POUR DES INSERT/UPDATE/DELETE !!
 */

class Descriptioncommande extends Model
{
    use HasFactory;

    protected $table = "descriptioncommande";
    protected $primaryKey = "iddescriptioncommande";
    public $timestamps = false;
    public $guarded = [];

    public function hebergement(): HasOne
    {
        return $this->hasOne(Hebergement::class, 'idhebergement', 'idhebergement');
    }
}
