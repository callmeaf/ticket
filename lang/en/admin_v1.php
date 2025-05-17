<?php

return [
    'mail' => [
        'status_changed' => [
            'subject' => 'Your ticket status has been updated – Ref: :ref_code',
            'title' => "Ticket :ref_code status changed",
            'body' => "The status of your ticket titled ':title' has been updated to **:status_text**.",
            'button' => 'View Ticket',
            'footer' => "Support Team",
            'notification_subject' => "Ticket status updated",
            'notification_payload' => "📌 Your ticket ':title' (Ref: :ref_code) status changed to **:status_text**.",
        ]
    ],
];
