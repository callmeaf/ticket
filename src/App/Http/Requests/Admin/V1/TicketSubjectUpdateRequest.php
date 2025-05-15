<?php

namespace Callmeaf\Ticket\App\Http\Requests\Admin\V1;

use Callmeaf\Ticket\App\Enums\TicketSubject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TicketSubjectUpdateRequest extends FormRequest
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
            'subject' => ['required',new Enum(TicketSubject::class)]
        ];
    }
}
