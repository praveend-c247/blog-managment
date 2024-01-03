<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:25',
            'short_description' => 'required',
            'description' => 'required',
            'blog_media' => $this->id ? '' : 'required',
            'date' => 'required',
            'time' => 'required',
            'tags' => 'required',
            'categories' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title' => __('validationMessage.title'),
            'title.max' => __('validationMessage.title_max_len'),
            'short_description' => __('validationMessage.short_description'),
            'description' => __('validationMessage.description'),
            'blog_media' => __('validationMessage.blog_media'),
            'date' => __('validationMessage.date'),
            'time' => __('validationMessage.time'),
            'tags' => __('validationMessage.tags'),
            'categories' => __('validationMessage.categories')
        ];
    }
}
