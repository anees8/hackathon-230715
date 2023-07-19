<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Sku;

class UniqueSizeForSkuRule implements ValidationRule
{

    protected $id;
    protected $name;

    public function __construct($name=null,$id=null)
    {
        $this->id = $id;
        $this->name = $name;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $fail("The $attribute must contain at least five unique sizes (XS, S, M, L, XL)");
        
        
        // . Missing sizes: $missingSizesString.");
        
    }
}
