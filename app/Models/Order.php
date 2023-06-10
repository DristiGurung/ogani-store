<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];
    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function getTotalAttribute($value){
        return $value/100;
        
    }
}
