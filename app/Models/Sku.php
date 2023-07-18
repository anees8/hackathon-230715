<?php

namespace App\Models;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

public function sizes(){
    return $this->hasMany(Size::class);
}

}
