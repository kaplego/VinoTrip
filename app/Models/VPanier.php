<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class VPanier extends Model
{
    use HasFactory;

    protected $table = "v_panier";
    protected $primaryKey = "idpanier";
    public $timestamps = false;

    public function descriptionspanier(): HasMany
    {
        return $this->hasMany(VDescriptionpanier::class, 'idpanier', 'idpanier');
    }

    public function codepromo(): HasOne
    {
        return $this->hasOne(
            CodePromo::class,
            'idcodepromo',
            'idcodepromo'
        );
    }
}
