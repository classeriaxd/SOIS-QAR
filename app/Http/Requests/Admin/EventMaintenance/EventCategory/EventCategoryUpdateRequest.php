<?php

namespace App\Http\Requests\Admin\EventMaintenance\EventCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EventCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category' => 'required|string|unique:App\Models\EventCategory,category,' . $this->category_id,
            'helper' => 'sometimes|string',
            'background_color' => 'required|regex:/^#([A-Fa-f0-9]{6})$/',
            'text_color' => 'required|regex:/^#([A-Fa-f0-9]{6})$/',
        ];
        return $rules;
    }
}
