<?php

namespace Callmeaf\Ticket\App\Http\Requests\Admin\V1;

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
            'receiver_identifier' => ['required',Rule::exists($userRepo->getTable(),$userRepo->getModel()->identifierKey())],
            'sender_identifier' => ['required',Rule::exists($userRepo->getTable(),$userRepo->getModel()->identifierKey())],
            'status' => ['required',new Enum(TicketStatus::class)],
            'type' => ['required',new Enum(TicketType::class)],
            'subject' => ['required',new Enum(TicketSubject::class)],
            'title' => ['required','string','max:255'],
            'content' => ['required','string','max:700'],
            'attachments' => ['nullable','array'],
            'attachments.*' => ['required','file','mimes:png,jpg,jpeg,pdf','max:2048']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sender_identifier' => $this->user()->identifier(),
        ]);
    }
}
