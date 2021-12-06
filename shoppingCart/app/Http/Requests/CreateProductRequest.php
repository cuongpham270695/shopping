<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name cannot be null',
            'name.unique' => 'Product name must be unique!',
            'name.max' => 'Product name cannot more than 255 character',
            'name.min' => 'Product name cannot less than 5 character',
            'price.required' => 'Price not be null',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot less than 0',
            'category_id.required' => 'You need to choose the category',
            'description.required' => 'You need to fill description'
        ];
    }
}
