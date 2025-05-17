<?php

namespace Callmeaf\Ticket\App\Listeners\Admin\V1;

use App\Models\User;
use Callmeaf\Ticket\App\Events\Admin\V1\TicketStatusUpdated;
use Callmeaf\Ticket\App\Notifications\Admin\V1\TicketStatusChangedNotification;

class ChangeTicketStatusManually
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
    public function handle(TicketStatusUpdated $event): void
    {
        $ticket = $event->ticket;
        /**
         * @var User $sender
         */
        $sender = $ticket->sender;
        $sender->notify(new TicketStatusChangedNotification($ticket));
    }
}
