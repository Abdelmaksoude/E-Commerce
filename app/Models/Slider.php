<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasTranslations;
    public $translatable = ['title','description'];
    use HasFactory;
    protected $fillable = ['title', 'description','photo'];
}
