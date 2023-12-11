<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Brand extends Model
{
    use Translatable;
    protected $fillable = ['title', 'description','photo'];
    public $translatedAttributes = ['title', 'description'];
    use HasFactory;
}
