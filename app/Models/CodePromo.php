<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodePromo extends Model
{
    use HasFactory;
    protected $table = "codepromo";
    protected $primaryKey = "idcodepromo";
    public $timestamps = false;
    public $guarded = [];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'idCodePromo', 'idCodePromo');
    }
    public function panier(): BelongsTo
    {
        return $this->belongsTo(Panier::class, 'idCodePromo', 'idCodePromo');
    }
}
