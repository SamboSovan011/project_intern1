<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductsRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|max:65535',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'SKU' => 'required',
            'image' =>'required|image',
            'category' =>'required',
            'discount' => 'between:0,100',
            'startDatePro' => 'date_format:m/d/Y',
            'stopDatePro' => 'date_format:m/d/Y',
        ];
    }
}
