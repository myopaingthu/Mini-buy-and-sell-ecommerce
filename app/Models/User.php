<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPassword;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable, SoftDeletes, ResetPassword;
    

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
        'last_login_at',
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
     * Get the rold that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

     /**
     * The favourites that belong to the user.
     */
    public function favourites()
    {
        return $this->belongsToMany(Product::class, 'favourites', 'user_id', 'product_id')->withTimeStamps();
    }

    /**  
    *Ondelete cascade for user
    */
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { 
             $user->products()->delete();
             $user->comments()->delete();
             $user->favourites()->delete();
        });
    }
}
