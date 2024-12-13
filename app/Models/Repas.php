<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repas extends Model
{
    use HasFactory;

    protected $table = "repas";
    protected $primaryKey = "idrepas";
    public $timestamps = false;

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'idpartenaire', 'idpartenaire');
    }
}
