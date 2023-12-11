<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class SubCategory extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['photo','category_id'];
    protected $translationForeignKey = 'sub_category_id';
    // public function Category()
    // {
    //     return $this->belongsTo(MainCategory::class, 'category_id');
    // }
    public function category()
    {
        return $this->belongsTo(MainCategory::class);
    }
}
