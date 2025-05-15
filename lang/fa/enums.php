<?php

use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\Ticket\App\Enums\TicketSubject;
use Callmeaf\Ticket\App\Enums\TicketType;

return [
    TicketStatus::class => [
        TicketStatus::OPEN->name => 'باز',
        TicketStatus::WAITING_FOR_ADMIN->name => 'در انتظار پاسخ ادمین',
        TicketStatus::WAITING_FOR_USER->name => 'در انتظار پاسخ کاربر',
        TicketStatus::ANSWERED->name => 'پاسخ داده شده',
        TicketStatus::CLOSED->name => 'بسته شده',
        TicketStatus::REOPENED->name => 'تیکت بسته شده، دوباره باز شده',
        TicketStatus::ARCHIVED->name => 'آرشیو شده'
    ],
    TicketType::class => [
        TicketType::LOW->name => 'کم',
        TicketType::MEDIUM->name => 'متوسط',
        TicketType::HIGH->name => 'زیاد',
        TicketType::URGENT->name => 'فوری'
    ],
    TicketSubject::class => [
        TicketSubject::TECHNICAL_ISSUE->name => 'مشکلات فنی',
        TicketSubject::BILLING->name => 'مشکلات پرداخت',
        TicketSubject::ACCOUNT->name => 'مشکلات حساب کاربری',
        TicketSubject::FEATURE_REQUEST->name => 'درخواست اضافه کردن قابلیت جدید',
        TicketSubject::OTHER->name => 'دیگر',
    ],
];
