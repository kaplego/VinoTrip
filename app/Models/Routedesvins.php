<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Routedesvins extends Model
{
    use HasFactory;
    protected $table = "route_des_vins";
    protected $primaryKey = "idroute";
    public $timestamps = false;

    public function Categorievignoble(): HasManyThrough
    {
        return $this->hasManyThrough(
            Categorievignoble::class,
            Selocalise::class,
            'idroute',
            'idcategorievignoble',
            'idroute',
            'idcategorievignoble'
        );
    }

}
