<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Panier extends Model
{
    use HasFactory;

    protected $table = "panier";
    protected $primaryKey = "idpanier";
    public $timestamps = false;

    public function descriptionspanier(): HasMany
    {
        return $this->hasMany(
            Descriptionpanier::class,
            'idpanier',
            'idpanier'
        );
    }
}
