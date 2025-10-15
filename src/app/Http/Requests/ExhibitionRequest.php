<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'condition' => ['required', 'integer'],
            'price' => ['required', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => '商品名',
            'description' => '商品の説明',
            'image' => '商品画像',
            'category_id' => 'カテゴリー',
            'condition' => '商品の状態',
            'price' => '商品価格',
        ];
    }
}
