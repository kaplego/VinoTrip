<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Avis extends Model
{
    use HasFactory;

    protected $table = "avis";
    protected $primaryKey = "idavis";
    public $timestamps = false;

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclient');
    }
}
