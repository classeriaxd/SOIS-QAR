<?php

namespace App\Http\Requests\StudentAccomplishmentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentAccomplishmentApproveRequest extends FormRequest
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
            'remarks' => 'required|string',
            'level' => 'required|integer|exists:levels,level_id',
            'fundSource' => 'required|integer|exists:fund_sources,fund_source_id',
            'budget' => 'sometimes|nullable|integer',
            'relatedEvent' => 'sometimes|nullable|integer|exists:events,event_id',
            'beneficiaries' => 'required|string',
            'activityType' => 'required|string',
        ];
        return $rules;
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'activityType' => 'activity type',
            'relatedEvent' => 'related event',
        ];
    }
}