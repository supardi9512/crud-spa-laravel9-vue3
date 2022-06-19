<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'     => 'required|unique:posts,title',
            'content'   => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Masukkan title post!',
            'title.unique' => 'Title post tidak boleh sama!',
            'content.required' => 'Masukkan content post!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response(new PostResource(false, $validator->errors(), null), 422);
        throw new ValidationException($validator, $response);
    }
}
