<?php

namespace App\Models;

use App\Models\Sku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function tailors()
    {
        return $this->belongsToMany(Tailor::class, 'tailor_product_type', 'product_type_id', 'tailor_id');
    }

}
