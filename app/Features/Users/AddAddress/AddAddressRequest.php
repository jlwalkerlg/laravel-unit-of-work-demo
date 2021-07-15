<?php

namespace App\Features\Users\AddAddress;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $line_1
 * @property string|null $line_2
 * @property string $city
 * @property string $postcode
 */
class AddAddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'line_1' => 'required',
            'line_2' => 'nullable',
            'city' => 'required',
            'postcode' => 'required',
        ];
    }
}
