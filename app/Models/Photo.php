<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photos";
    protected $primaryKey = "idphoto";
    public $timestamps = false;
    public $guarded = [];

    public function sejour(): BelongsTo
    {
        return $this->belongsTo(Sejour::class, 'idsejour', 'idsejour');
    }
}

