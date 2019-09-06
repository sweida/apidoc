<?php

namespace App\Http\Requests;

class LinkRequest extends FormRequest
{
    public function rules()
    {
        if (FormRequest::getPathInfo() == '/api/v1/link/add'){
            return [
                'title' => ['required'],
                'type' => ['required'],
                'url' => ['required'],
            ];
        } else {
            return [
                'id' => ['required', 'exists:links,id']
            ];
        }

    }

    public function messages()
    {
        return [
            'title.required'=>'名称不能为空',
            'url.required' => '链接不能为空',
            'type.required' => '类型不能为空',
            'id.required' => 'id不能为空',
            'id.exists' => 'id不存在',
        ];
    }
}
