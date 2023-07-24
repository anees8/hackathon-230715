<?php

namespace App\Models;
use App\Models\Order;
use App\Models\OrderTailor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tailor extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_tailor')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class, 'tailor_product_type', 'tailor_id', 'product_type_id');
    }

    public function tailer_order()
    {
        return $this->belongsToMany(OrderTailor::class, 'order_tailors', 'id', 'tailer_id');
    }

}