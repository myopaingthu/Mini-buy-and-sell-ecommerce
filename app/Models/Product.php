<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name',
                         'category_id',
                         'description',
                         'price',
                         'user_id',
                         'phone',
                         'address',
                         'available'
                        ];
    protected $dates = ['createt_at'];

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comment associated with the product.
     */
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

     /**
     * Get the comment associated with the product.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

     /**
     * Get the image associated with the product.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

       /**  
    *Ondelete cascade for product
    */
    public static function boot() {
        parent::boot();

        static::deleting(function($product) { 
             $product->comments()->delete();
             $product->images()->delete();
             $product->favourites()->delete();
        });
    }
}
