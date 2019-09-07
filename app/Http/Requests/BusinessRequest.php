<?php

namespace App\Http\Requests;

class BusinessRequest extends FormRequest
{
    public function rules()
    {
        if (FormRequest::getPathInfo() == '/api/v1/business/list'){
            return [
                'count' => ['max:20', 'between:1,20'],
            ];
        }

    }

    public function messages()
    {
        return [
            'count.max'=>'最多只能20个!',
            'count.between' => '最多只能20个',
        ];
    }
}
