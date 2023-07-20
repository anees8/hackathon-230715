<?php

namespace App\Models;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tailor extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function orders(){
      return $this->hasMany(Order::class);
    }

    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class, 'tailor_product_type', 'tailor_id', 'product_type_id');
    }
}