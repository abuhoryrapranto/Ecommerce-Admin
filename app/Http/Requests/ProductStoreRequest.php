<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string',
            'brand_id'      => 'required',
            'type_id'       => 'required',
            'sub_type_id'   => 'required',
            'main_price'    => 'required|numeric',
            'status'        => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Product name field is required',
            'brand_id.required' => 'Brand name field is required',
            'type_id.required' => 'Type name field is required',
            'sub_type_id.required' => 'Sub Type name field is required'
        ];
    }
}
