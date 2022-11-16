<?php

namespace Modules\Blog\Http\Requests\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $blogCategory = $this->route('blog_category');

        return [
            'title' => $this->input('title') !== $blogCategory->title ? 'bail|required|string|max:255|unique:blog_categories' : ''
        ];
    }
}
