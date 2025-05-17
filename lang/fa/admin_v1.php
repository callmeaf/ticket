<?php

return [
    'mail' => [
        'status_changed' => [
            'subject' => 'وضعیت تیکت شما بروزرسانی شد – کد: :ref_code',
            'title' => "وضعیت تیکت :ref_code تغییر کرد",
            'body' => "وضعیت تیکت شما با عنوان «:title» به **:status_text** تغییر یافته است.",
            'button' => 'مشاهده تیکت',
            'footer' => "تیم پشتیبانی",
            'notification_subject' => "وضعیت تیکت تغییر کرد",
            'notification_payload' => "📌 وضعیت تیکت شما با عنوان «:title» (کد: :ref_code) به **:status_text** تغییر یافت.",
        ]
    ],
];
