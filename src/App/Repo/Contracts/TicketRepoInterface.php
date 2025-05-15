<?php

namespace Callmeaf\Ticket\App\Repo\Contracts;

use Callmeaf\Base\App\Repo\Contracts\BaseRepoInterface;
use Callmeaf\Ticket\App\Models\Ticket;
use Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketCollection;
use Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketResource;

/**
 * @extends BaseRepoInterface<Ticket,TicketResource,TicketCollection>
 */
interface TicketRepoInterface extends BaseRepoInterface
{

}
