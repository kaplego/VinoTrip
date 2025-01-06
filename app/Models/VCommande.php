<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class VCommande extends Model
{
    use HasFactory;

    protected $table = "v_commande";
    protected $primaryKey = "idcommande";
    public $timestamps = false;
    public $guarded = [];

    public function beneficiaire(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclientbeneficiaire');
    }

    public function acheteur(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclientacheteur');
    }

    public function descriptionscommande(): HasMany
    {
        return $this->hasMany(VDescriptioncommande::class,  'idcommande', 'idcommande');
    }

    public function cartebancaire(): HasOne
    {
        return $this->hasOne(Cartebancaire::class, 'idcb', 'idcb');
    }
}
