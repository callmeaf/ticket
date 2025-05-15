<?php

use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\Ticket\App\Enums\TicketSubject;
use Callmeaf\Ticket\App\Enums\TicketType;

return [
    TicketStatus::class => [
        TicketStatus::OPEN->name => 'Open',
        TicketStatus::WAITING_FOR_ADMIN->name => 'Waiting for admin',
        TicketStatus::WAITING_FOR_USER->name => 'Waiting for user',
        TicketStatus::ANSWERED->name => 'Answered',
        TicketStatus::CLOSED->name => 'Closed',
        TicketStatus::REOPENED->name => 'Reopened',
        TicketStatus::ARCHIVED->name => 'Archived'
    ],
    TicketType::class => [
        TicketType::LOW->name => 'Low',
        TicketType::MEDIUM->name => 'Medium',
        TicketType::HIGH->name => 'High',
        TicketType::URGENT->name => 'Urgent'
    ],
    TicketSubject::class => [
        TicketSubject::TECHNICAL_ISSUE->name => 'Technical Issue',
        TicketSubject::BILLING->name => 'Billing',
        TicketSubject::ACCOUNT->name => 'Account',
        TicketSubject::FEATURE_REQUEST->name => 'Feature Request',
        TicketSubject::OTHER->name => 'Other',
    ],
];
