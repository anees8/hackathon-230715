<?php

namespace App\Models;
use App\Models\Size;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function product_type()
    {
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }
}
