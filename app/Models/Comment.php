<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'product_id','user_id'];

    /**
    * Get the product that owns the comment.
    */
   public function product()
   {
       return $this->belongsTo(Product::class);
   }

    /**
    * Get the user that owns the comment.
    */
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
