<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Descriptioncommande extends Model
{
    use HasFactory;

    protected $table = "descriptioncommande";
    protected $primaryKey = "iddescriptioncommande";
    public $timestamps = false;
    public $guarded = [];

    public function sejour(): BelongsTo
    {
        return $this->belongsTo(Sejour::class, 'idsejour', 'idsejour');
    }

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Panier::class, 'idcommande', 'idcommande');
    }

    public function hebergement(): HasOne
    {
        return $this->hasOne(Hebergement::class, 'idhebergement', 'idhebergement');
    }


    public function repas(): HasManyThrough
    {
        return $this->hasManyThrough(
            Repas::class,
            Mange1::class,
            'iddescriptioncommande',
            'idrepas',
            'iddescriptioncommande',
            'idrepas',
        );
    }
}

