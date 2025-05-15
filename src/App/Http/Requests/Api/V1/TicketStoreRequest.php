<?php

namespace Callmeaf\Ticket\App\Http\Requests\Api\V1;

use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\Ticket\App\Enums\TicketSubject;
use Callmeaf\Ticket\App\Enums\TicketType;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TicketStoreRequest extends FormRequest
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
    public function rules(UserRepoInterface $userRepo): array
    {
        return [
            'sender_email' => ['required',Rule::exists($userRepo->getTable(),'email')],
            'status' => ['required',new Enum(TicketStatus::class)],
            'type' => ['required',new Enum(TicketType::class)],
            'subject' => ['required',new Enum(TicketSubject::class)],
            'title' => ['required','string','max:255'],
            'content' => ['required','string','max:700'],
            'attachments' => ['nullable','array'],
            'attachments.*' => ['required','file','mimes:png,jpg,jpeg,pdf','max:2048']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sender_email' => $this->user()->email,
        ]);
    }
}
