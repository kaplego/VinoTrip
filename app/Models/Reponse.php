<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reponse extends Model
{
    use HasFactory;
    protected $table = "reponse";
    protected $primaryKey = "idreponse";
    public $timestamps = false;
    public $guarded = [];
}
