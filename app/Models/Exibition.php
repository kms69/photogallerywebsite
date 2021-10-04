<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exibition extends Model
{
    use HasFactory;
    protected $fillable = ['cover_image','exhibitions_title','exhibitions_date', 'exhibitions_location'];
}
