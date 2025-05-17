<?php

namespace Callmeaf\Ticket\App\Http\Requests\Api\V1;

use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TicketStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * @var TicketRepoInterface $ticketRepo
         */
        $ticketRepo = app(TicketRepoInterface::class);
        $ticket = $ticketRepo->findById($this->route('ticket'));

        $status = $this->get('status');
        return $ticket->resource->isCreatedBy(user: $this->user()) && ($status === TicketStatus::ARCHIVED->value || $status === TicketStatus::CLOSED->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required',new Enum(TicketStatus::class)],
        ];
    }
}
