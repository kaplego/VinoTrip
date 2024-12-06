<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Etape extends Model
{
    use HasFactory;

    protected $table = "etape";
    protected $primaryKey = "idetape";
    public $timestamps = false;


    public function hebergement(): HasMany
    {
        return $this->hasMany(Hebergement::class, 'idhebergement', 'idhebergement');
    }


    public function visite(): HasManyThrough
    {
        return $this->hasManyThrough(
            Visite::class,
            Appartient_1::class,
            'idetape',
            'idvisite',
            'idetape',
            'idvisite'
        );
    }

    public function activites(): HasManyThrough
    {
        return $this->hasManyThrough(
            Activite::class,
            Appartient_4::class,
            'idetape',
            'idactivite',
            'idetape',
            'idactivite'
        );
    }
}


