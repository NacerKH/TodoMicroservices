<?php

namespace App\Modules\TodoList\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeStatusTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'list_task_id' => 'required|integer|exists:list_tasks,id',
        ];
    }
}
