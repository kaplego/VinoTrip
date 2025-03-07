<?php
namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'emailclient',
        'motdepasseclient',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'motdepasseclient',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $table = "client";
    protected $primaryKey = "idclient";
    public $timestamps = false;


    public function getAuthPassword()
    {
        return $this->motdepasseclient;
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'idrole', 'idrole');
    }

    public function adresses(): HasMany
    {
        return $this->hasMany(Adresse::class, 'idclient', 'idclient');
    }

    public function cartebancaire(): HasOne
    {
        return $this->hasOne(Cartebancaire::class, 'idclient', 'idclient')->where('actif', '=', true);
    }

    public function commandes(): HasMany
    {
        return $this->HasMany(VCommande::class, 'idclientacheteur', 'idclient')->orderBy('datecommande', 'desc');
    }

    public function favoris(): HasManyThrough
    {
        return $this->hasManyThrough(
            Sejour::class,
            Favoris::class,
            'idclient',
            'idsejour',
            'idclient',
            'idsejour',

        );
    }
}
