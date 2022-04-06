<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'password',
        'price',
        'category',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'rating_value' => 0,
        'rating_times' => 0
    ];

    // Adding relationship
    public function Category()
    {
        return $this->belongsTo(Category::class, 'id');
    }

    // Relationship with users table
    public function users()
    {
        return $this->belongsToMany(User::class, 'carts', 'id_product', 'id_user')->withPivot(['quantity', 'deleted_at'])
        ->wherePivotNull('deleted_at')->withTimestamps();
    }
}
