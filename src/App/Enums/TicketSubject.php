<?php

namespace Callmeaf\Ticket\App\Enums;

enum TicketSubject: string
{
    case TECHNICAL_ISSUE = 'technical_issue';
    case BILLING = 'billing';
    case ACCOUNT = 'account';
    case FEATURE_REQUEST = 'feature_request';
    case OTHER = 'other';
}
