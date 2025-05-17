<?php

namespace Callmeaf\Ticket\App\Listeners\Api\V1;

use App\Models\User;
use Callmeaf\Ticket\App\Events\Api\V1\TicketCreated;
use Callmeaf\Ticket\App\Notifications\Api\V1\TicketCreatedNotification;

class NotifyCreatorTicket
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreated $event): void
    {
        $ticket = $event->ticket;
        /**
         * @var User $user
         */
        $sender = $ticket->sender;
        $sender->notify(new TicketCreatedNotification($ticket));
    }
}
