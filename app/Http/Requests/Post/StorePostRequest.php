<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\MainRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'category_id'=>'required | integer | exists:categories,id',
            'slug' => ['sometimes','nullable','string'],
            'title'=>'required | string',
            'content'=>'required | string',
        ];
    }
    public function messages()
    {
        return [
            'user_id.integer' => 'The user ID must be a valid integer.',
            'user_id.exists' => 'The user ID must exist in the users table.',
            'category_id.required' => 'The category ID is required.',
            'category_id.integer' => 'The category ID must be a valid integer.',
            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug must be a valid string.',
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a valid string.',
            'content.required' => 'The content is required.',
            'content.string' => 'The content must be a valid string.',
        ];
    }
}
