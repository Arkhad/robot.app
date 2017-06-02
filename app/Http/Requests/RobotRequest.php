<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RobotRequest extends FormRequest
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
        return [
            'name' => 'bail|required|string', // bail stop au premier fail
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id', // robot non catégorisé => value="" ou catégorisé et dans ce cas on vérifie que la ressource est bien en base de données
            'tags.*' => 'exists:tags,id',
            'status' => 'in:published',
            'link' => 'image|max:' . env('MAX_UPLOAD', 3000)
        ];
    }
}
