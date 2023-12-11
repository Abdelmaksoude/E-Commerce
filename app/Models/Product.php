<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['title','description'];
    protected $fillable = ['photo','sales-count','rate','price','discount_percent','discount_value','final_value','category_id','sub_category_id','brand_id'];
    protected $translationForeignKey = 'product_id';

    public function Category()
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }

    public function Sub_Category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function Photos(): HasMany
    {
        return $this->hasMany(ProductAttachment::class);
    }
}
