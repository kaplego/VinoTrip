<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
