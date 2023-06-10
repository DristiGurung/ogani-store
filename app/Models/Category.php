<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function setImageUrlAttribute($value){
        $path = $value->store('public');
        $this->attributes['image_url'] = $path;
    }
    
}