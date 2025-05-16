<?php

namespace Callmeaf\Ticket\App\Repo\V1;

use Callmeaf\Base\App\Enums\RandomType;
use Callmeaf\Base\App\Repo\V1\BaseRepo;
use Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketResource;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;

class TicketRepo extends BaseRepo implements TicketRepoInterface
{
    public function create(array $data)
    {
        $data['ref_code'] = $this->newRefCode();

        /**
         * @var TicketResource $ticket
         */
        $ticket = parent::create($data);

        $attachments = $data['attachments'] ?? [];

        if(! empty ($attachments)) {
            $this->addMultiMedia($ticket,$data['attachments']);
        }

        return $this->toResource($ticket->resource->loadMissing([
            'attachments'
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
            'attachments'
        ]));
    }

    public function newRefCode(): string
    {
        $refCode = \Base::random(length: $this->config['ref_code_length'],type: RandomType::NUMBER);
        $prefixRefCode = $this->config['ref_code_prefix'];
        $refCode = $prefixRefCode . $refCode;

        if($this->getQuery(fresh: true)->where($this->modelKeyName(),$refCode)->exists()) {
            return $this->newRefCode();
        }

        return $refCode;
    }
}
