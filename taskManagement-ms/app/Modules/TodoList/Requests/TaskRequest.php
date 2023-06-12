<?php

namespace App\Modules\TodoList\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->merge([
            'user_id' => $this->header('X-User-Id'),
        ]);
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
            'title'=>'required|string',
            'content'=>'required|string',
            'priority' => 'required|integer|between:1,3',
            'date_of_completion' => 'required|date|after_or_equal:now',
            'list_task_id'=> 'required|integer|exists:list_tasks,id',
            'user_id'=> 'required|integer'
        ];
    }
}
