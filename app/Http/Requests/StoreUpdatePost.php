<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\This;

class StoreUpdatePost extends FormRequest
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
        $id = $this->segment(3);

        $rules = [
            'title' => ['required',
            'min:3',
            'max:160',
            "unique:posts,title,{$id},id"
            ],
            'content' => ['required', 'min:5' ,'max:100'],
            'image' =>['required', 'image']
        ];

        if($this->method() == 'PUT'){
            $rules['image'] = ['nullable',' image'];
        }
        return [

        ];
    }
}
