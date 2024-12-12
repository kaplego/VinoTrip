<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorievignoble extends Model
{
    use HasFactory;

    protected $table = "categorievignoble";
    protected $primaryKey = "idcategorievignoble";
    public $timestamps = false;

    public function Sejour(): HasMany
    {
        return $this->hasMany(
            Sejour::class,
            'idcategorievignoble',
            'idcategorievignoble'
        );
    }
}
