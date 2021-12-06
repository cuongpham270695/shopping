<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
            'name' => 'required|unique:sliders|min:5|max:255',
            'description' => 'required|min:5|max:300',
            'image_path' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Slider name cannot be null!',
            'name.unique' => 'Slider name must be unique',
            'name.min' => 'Slider name cannot less than 5 characters',
            'name.max' => 'Slider name cannot more than 255 characters',
            'description.required' => 'Description cannot be null',
            'description.min' => 'Description cannot less than 5 characters',
            'description.max' => 'Description cannot more than 300 characters',
            'image_path.required' => 'Choose image please!'
        ];
    }
}
