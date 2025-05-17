<?php

return [
    'mail' => [
        'created' => [
            'subject' => 'Your support ticket has been created – Ref: :ref_code',
            'title' => "Your ticket :ref_code has been created",
            'body' => "We've received your request titled ':title'. Our support team will review it and get back to you soon.",
            'button' => 'Show Ticket',
            'footer' => "Support Team",
            'notification_subject' => "New ticket submitted",
            'notification_payload' => "📩 Ticket ':title' has been submitted.\nReference code: :ref_code\nWe'll notify you once there's an update.",
        ]
    ],
];
