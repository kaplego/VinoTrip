<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Commande extends Model
{
    use HasFactory;

    protected $table = "commande";
    protected $primaryKey = "idcommande";
    public $timestamps = false;

    public function beneficiaire(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclientbeneficiaire');
    }

    public function acheteur(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclientacheteur');
    }

    public function descriptioncommande(): HasOne
    {
        return $this->hasOne(Descriptioncommande::class, 'idcommande', 'idcommande');
    }

}
