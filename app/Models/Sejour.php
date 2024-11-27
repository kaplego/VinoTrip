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

    public function categoriesejour(): HasOne
    {
        return $this->hasOne(Categoriesejour::class, 'idcategoriesejour', 'idcategoriesejour');
    }

    public function destination(): HasOne
    {
        return $this->hasOne(Destination::class, 'iddestination', 'iddestination');
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

    public function categorieparticipant(): HasManyThrough
    {
        return $this->hasManyThrough(
            Categorieparticipant::class,
            Destinea::class,
            'idsejour',
            'idcategorieparticipant',
            'idsejour',
            'idcategorieparticipant'
        );
    }
}
