<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','product_id'];

    /**
     * Get the user that owns the favourite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the product that owns the favourite.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
