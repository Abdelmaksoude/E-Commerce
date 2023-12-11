<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = ['photo','name','address','phone','email','link_twitter','link_instgram','link_facebook','link_linkedin'];
}
