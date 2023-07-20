<?php

namespace App\Models;
use App\Models\Sku;
use App\Models\Tailor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function sku()
{
    return $this->belongsTo(Sku::class);
}

public function tailor()
{
    return $this->belongsTo(Tailor::class);
}


}
