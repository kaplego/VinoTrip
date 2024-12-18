<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Visite extends Model
{
    use HasFactory;

    protected $table = "visite";
    protected $primaryKey = "idvisite";
    public $timestamps = false;

    public function cave(): HasMany
    {
        return $this->hasMany(Cave::class, 'idpartenaire', 'idpartenaire');
    }
}
