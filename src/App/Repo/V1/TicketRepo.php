<?php

namespace Callmeaf\Ticket\App\Repo\V1;

use Callmeaf\Base\App\Repo\V1\BaseRepo;
use Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketResource;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;

class TicketRepo extends BaseRepo implements TicketRepoInterface
{
    public function create(array $data)
    {
        /**
         * @var TicketResource $ticket
         */
        $ticket = parent::create($data);

        $attachments = $data['attachments'] ?? [];

        if(! empty ($attachments)) {
            $this->addMultiMedia($ticket,$data['attachments']);
        }

        return $this->toResource($ticket->resource->loadMissing([
            'media'
        ]));
    }

    public function update(mixed $id, array $data)
    {
        /**
         * @var TicketResource $ticket
         */
        $ticket = parent::update(id: $id,data: $data);

        $attachments = $data['attachments'] ?? [];

        if(! empty($attachments)) {
            $this->addMultiMedia($ticket,$data['attachments']);
        }

        return $this->toResource($ticket->resource->loadMissing([
            'media'
        ]));
    }
}
