<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // No '/' and one '.' with only "txt", "php", and "html" file extensions
            'filename' => ['required','not_regex:/^.+\/.+$/','regex:/^.+\.(?:php|html|txt)/'],
            'module_id' => ['required', Rule::in(Auth::user()->modules->pluck('id'))],
            'week' => 'required|integer|max:12|min:0',
            'topics' => 'array|nullable',
            // All topics must be of the same module as the chosen module
            'topics.*' => Rule::in(Topic::where('module_id', request()->module_id)->pluck('id')->toArray())
        ];
    }
}
