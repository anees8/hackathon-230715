<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Sku;

class UniqueSizeForSkuRule implements ValidationRule
{

    protected $id;
    protected $sku_code;

    public function __construct($sku_code=null,$id=null)
    {
        $this->id = $id;
        $this->sku_code = $sku_code;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

            $skuQuery = Sku::where('sku_code',$this->sku_code)->where('size_id', $value)->count();
            $skuQuerywithId = Sku::where('id',$this->id)->where('size_id', $value)->where('sku_code',$this->sku_code)->count();
            if($skuQuerywithId == 0 && $skuQuery==1){
            $fail("The $attribute must contain at  unique sizes");
            }
        
    }
}
