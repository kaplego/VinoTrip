<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Descriptioncommande extends Model
{
    use HasFactory;

    protected $table = "descriptioncommande";
    protected $primaryKey = "idcommande";
    public $timestamps = false;
    public $guarded = [];

    public function sejour(): BelongsTo
    {
        return $this->belongsTo(Sejour::class, 'idsejour', 'idsejour');
    }

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Panier::class, 'idcommande', 'idcommande');
    }





}

