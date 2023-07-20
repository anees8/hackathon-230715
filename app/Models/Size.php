<?php

namespace App\Models;
use App\Models\Sku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sku(){
    return $this->belongsTo(Sku::class);
}

}
