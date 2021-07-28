<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'role_id',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the product associated with the user.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

     /**
     * Get the comment associated with the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

     /**
     * Get the favourite associated with the user.
     */
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

     /**
     * Get the rold that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
