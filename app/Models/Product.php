<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];
    public function formatted_amount()
    {
        return 'RS ' . $this->price;
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
         $this->attributes['slug'] = str()->slug($value);
    }

    public function setPriceAttribute($value)
    {
        return $this->attributes['price'] = $value*100;
    }
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
    //{
    //     return Attribute::make(
    //         get: function($value){
    //             return $value / 100;
    //         },
    //         set: function($value){
    //             return $value * 100;
    //         }
    //     );
    // }
}