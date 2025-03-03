<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role_id',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(Annonce::class, 'favoris', 'user_id', 'annonce_id');
    }

    // add an annonce to favorites
    public function favorite(Annonce $annonce)
    {
        $this->favoris()->attach($annonce->id);
    }

    // remove an annonce from favorites
    public function unfavorite(Annonce $annonce)
    {
        $this->favoris()->detach($annonce->id);
    }

    public function hasFavorited(Annonce $annonce)
    {
        return $this->favoris()->where('annonce_id', $annonce->id)->exists();
    }
}
