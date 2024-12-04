<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hebergement extends Model
{
    use HasFactory;

    protected $table = "hebergement";
    protected $primaryKey = "idhebergement";
    public $timestamps = false;

    public function hotel(): HasMany
    {
        return $this->hasMany(Hotel::class, 'idpartenaire', 'idpartenaire');
    }
}
