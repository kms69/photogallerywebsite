<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','publish_date','category_id'];

    public function category()
    {
        return $this->hasMany(Category::class,'category_id');
    }
}
