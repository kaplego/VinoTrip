<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hebergement extends Model
{
    use HasFactory;

    protected $table = "hebergement";
    protected $primaryKey = "idhebergement";
    public $timestamps = false;

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'idpartenaire', 'idpartenaire');
    }

    public function etapes(): HasMany
    {
        return $this->hasMany(Etape::class, 'idhebergement', 'idhebergement');
    }
}
