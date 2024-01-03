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
            'short_description' => 'required|min:5|max:100',
            'description' => 'required|min:250',
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
            'short_description.min' => __('validationMessage.short_description_min'),
            'short_description.max' => __('validationMessage.short_description_max'),
            'description' => __('validationMessage.description'),
            'description.min' => __('validationMessage.description_max'),
            'blog_media' => __('validationMessage.blog_media'),
            'date' => __('validationMessage.date'),
            'time' => __('validationMessage.time'),
            'tags' => __('validationMessage.tags'),
            'categories' => __('validationMessage.categories')
        ];
    }
}
