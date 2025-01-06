<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VDescriptionpanier extends Model
{
    use HasFactory;

    protected $table = "v_descriptionpanier";
    protected $primaryKey = "iddescriptionpanier";
    public $timestamps = false;

    public function sejour(): BelongsTo
    {
        return $this->belongsTo(Sejour::class, 'idsejour', 'idsejour');
    }

    public function panier(): BelongsTo
    {
        return $this->belongsTo(Panier::class, 'idpanier', 'idpanier');
    }

    public function hebergement(): HasOne
    {
        return $this->hasOne(Hebergement::class, 'idhebergement', 'idhebergement');
    }

    public function activites(): HasManyThrough
    {
        return $this->hasManyThrough(
            Activite::class,
            Association_38::class,
            'iddescriptionpanier',
            'idactivite',
            'iddescriptionpanier',
            'idactivite',
        );
    }

    public function repas(): HasManyThrough
    {
        return $this->hasManyThrough(
            Repas::class,
            Association_39::class,
            'iddescriptionpanier',
            'idrepas',
            'iddescriptionpanier',
            'idrepas',
        );
    }
}
