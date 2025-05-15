<?php

namespace Callmeaf\Ticket\App\Enums;


enum TicketStatus: string
{
    case OPEN = 'open';
    case WAITING_FOR_ADMIN = 'waiting_for_admin';
    case WAITING_FOR_USER = 'waiting_for_user';
    case ANSWERED = 'answered';
    case CLOSED = 'closed';
    case REOPENED = 'reopened';
    case ARCHIVED = 'archived';
}
