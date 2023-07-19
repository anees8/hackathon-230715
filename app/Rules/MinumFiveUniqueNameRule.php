<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Sku;

class MinumFiveUniqueNameRule implements ValidationRule
{

    protected $id;

    public function __construct($id=null)
    {
        $this->id = $id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {   
       
        $skuQuery = Sku::where('name', $value)->count();
        $skuQuerywithId = Sku::where('name', $value)->where('id',$this->id)->count();
        if ($skuQuerywithId == 0 && $skuQuery >=5) {
        $fail("The $attribute must contain at least five unique names.");
        }
        
    }
}
