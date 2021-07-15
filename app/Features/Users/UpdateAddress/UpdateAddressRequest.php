<?php

namespace App\Features\Users\UpdateAddress;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $line_1
 * @property string|null $line_2
 * @property string $city
 * @property string $postcode
 */
class UpdateAddressRequest extends FormRequest
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
