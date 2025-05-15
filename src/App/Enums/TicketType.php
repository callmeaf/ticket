<?php

namespace Callmeaf\Ticket\App\Enums;

enum TicketType: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';
}
