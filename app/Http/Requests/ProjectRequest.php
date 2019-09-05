<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
        public function rules()
    {
        if (FormRequest::getPathInfo() == '/api/v1/project/add'){
            return [
                'title' => ['required'],
            ];
        } else {
            return [
                'id' => ['required', 'exists:projects,id']
            ];
        }

    }

    public function messages()
    {
        return [
            'title.required'=>'项目名称不能为空',
            'id.required'=>'id不能为空',
            'id.exists'=>'id不存在',
        ];
    }
}
