<?php

namespace App\Http\Requests\Admin\EventMaintenance\Level;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LevelUpdateRequest extends FormRequest
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
            'level' => 'required|string|unique:App\Models\Level,level,' . $this->level_id,
            'helper' => 'sometimes|string',
        ];
        return $rules;
    }
}
