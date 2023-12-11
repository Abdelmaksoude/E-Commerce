<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    protected $fillable = ['title', 'description'];
    public $timestamps = false;
    use HasFactory;
}
