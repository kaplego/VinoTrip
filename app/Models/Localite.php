<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Localite extends Model
{
    use HasFactory;

    protected $table = "localite";
    protected $primaryKey = "idlocalite";
    public $timestamps = false;

    public function vignoble(): HasOne
    {
        return $this->hasOne(Categorievignoble::class, 'idcategorievignoble', 'idcategorievignoble');
    }
}
