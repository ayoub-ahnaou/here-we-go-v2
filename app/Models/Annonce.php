<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'country',
        'city',
        'disponibility',
        'equipements',
        'price',
        'user_id',
        'category_id',
        'images'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favoris', 'annonce_id', 'user_id');
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    public static function search($input = null)
    {
        $searchQuery = self::query();

        if (!empty($input)) {
            if (preg_match('/^\d{4}$/', $input)) {
                $searchQuery->whereYear('disponibility', '=', $input);
            } elseif (strtotime($input)) {
                $searchQuery->whereYear('disponibility', '=', date('Y', strtotime($input)));
            } else {
                $searchQuery->where(function ($search) use ($input) {
                    $search->where('title', 'like', "%$input%")
                        ->orWhere('city', 'like', "%$input%")
                        ->orWhere('country', 'like', "%$input%")
                        ->orWhere('equipements', 'like', "%$input%")
                        ->orWhere('price', intval($input));
                });
            }
        }

        return $searchQuery->orderBy('created_at', 'desc')
            ->paginate(12);
    }
}
