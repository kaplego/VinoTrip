<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cartebancaire extends Model
{
    use HasFactory;

    protected $table = "carte_bancaire";
    protected $primaryKey = "idcb";
    public $timestamps = false;
    public $guarded = [];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'idclient', 'idclient');
    }
}
