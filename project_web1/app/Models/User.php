<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'version' => 0,
    ];


    // Relationship with products table
    // This function only load products that has column deleted_at with value null
    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts', 'id_user', 'id_product')->withPivot(['quantity', 'deleted_at'])
            ->wherePivotNull('deleted_at')->withTimestamps();
    }

    // FUNCTION TO EAGER LOADING PRODUCTS TABLE
    public function loadProductsWithTrash()
    {
        return $this->belongsToMany(Product::class, 'carts', 'id_user', 'id_product')->withPivot(['quantity', 'deleted_at'])
            ->withTimestamps();
    }
}
