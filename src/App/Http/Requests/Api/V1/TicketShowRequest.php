<?php

namespace Callmeaf\Ticket\App\Http\Requests\Api\V1;

use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;
use Illuminate\Foundation\Http\FormRequest;

class TicketShowRequest extends FormRequest
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
        return $ticket->resource->isCreatedBy(user: $this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
