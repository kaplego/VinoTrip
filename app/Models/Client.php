<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $primaryKey = "idclient";
    public $timestamps = false;

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'idrole', 'idrole');
    }
}
