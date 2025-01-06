<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sejour extends Model
{
    use HasFactory;

    protected $table = "sejour";
    protected $primaryKey = "idsejour";
    public $timestamps = false;
    public $guarded = [];

    public function categoriesejour(): HasOne
    {
        return $this->hasOne(Categoriesejour::class, 'idcategoriesejour', 'idcategoriesejour');
    }

    public function theme(): HasOne
    {
        return $this->hasOne(Theme::class, 'idtheme', 'idtheme');
    }

    public function categorievignoble(): HasOne
    {
        return $this->hasOne(Categorievignoble::class, 'idcategorievignoble', 'idcategorievignoble');
    }

    public function duree(): HasOne
    {
        return $this->hasOne(Duree::class, 'idduree', 'idduree');
    }

    public function categorieparticipant(): HasOne
    {
        return $this->hasOne(
            Categorieparticipant::class,
            'idcategorieparticipant',
            'idcategorieparticipant'
        );
    }

    public function localite(): HasOne
    {
        return $this->hasOne(
            Localite::class,
            'idlocalite',
            'idlocalite'
        );
    }

    public function etape(): HasMany
    {
        return $this->hasMany(
            Etape::class,
            'idsejour',
            'idsejour',
        );
    }
    public function avis(): HasMany
    {
        return $this->hasMany(
            Avis::class,
            'idsejour',
            'idsejour',
        );
    }
}
