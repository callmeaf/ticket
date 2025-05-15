<?php

namespace Callmeaf\Ticket\App\Events\Admin\V1;

use Callmeaf\Ticket\App\Models\Ticket;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketTrashed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Collection<Ticket> $tickets
     * Create a new event instance.
     */
    public function __construct(Collection $tickets)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
