<?php

namespace Callmeaf\Ticket\App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @extends ResourceCollection<TicketResource>
 */
class TicketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, TicketResource>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
