<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayNotNullRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($value as $val){
            if($val == NULL || empty($val))
                return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have to fill all the add member deatils please fill all and try again.';
    }
}
