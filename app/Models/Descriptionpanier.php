<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Descriptionpanier extends Model
{
    use HasFactory;

    protected $table = "descriptionpanier";
    protected $primaryKey = "idpanier";
    public $timestamps = false;
    public $guarded = [];

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

    public function repas(): HasManyThrough
    {
        return $this->hasManyThrough(Association_38::class, 'idhebergement', 'idhebergement');
    }
}
