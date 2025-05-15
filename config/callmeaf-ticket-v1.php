<?php

use Callmeaf\Base\App\Enums\RequestType;

return [
    'model' => \Callmeaf\Ticket\App\Models\Ticket::class,
    'route_key_name' => 'ref_code',
    'repo' => \Callmeaf\Ticket\App\Repo\V1\TicketRepo::class,
    'resources' => [
        RequestType::API->value => [
            'resource' => \Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketResource::class,
            'resource_collection' => \Callmeaf\Ticket\App\Http\Resources\Api\V1\TicketCollection::class,
        ],
        RequestType::WEB->value => [
            'resource' => \Callmeaf\Ticket\App\Http\Resources\Web\V1\TicketResource::class,
            'resource_collection' => \Callmeaf\Ticket\App\Http\Resources\Web\V1\TicketCollection::class,
        ],
        RequestType::ADMIN->value => [
            'resource' => \Callmeaf\Ticket\App\Http\Resources\Admin\V1\TicketResource::class,
            'resource_collection' => \Callmeaf\Ticket\App\Http\Resources\Admin\V1\TicketCollection::class,
        ],
    ],
    'events' => [
        RequestType::API->value => [
            \Callmeaf\Ticket\App\Events\Api\V1\TicketIndexed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketCreated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketShowed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketDeleted::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Api\V1\TicketTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::WEB->value => [
            \Callmeaf\Ticket\App\Events\Web\V1\TicketIndexed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketCreated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketShowed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketDeleted::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Web\V1\TicketTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::ADMIN->value => [
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketIndexed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketCreated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketShowed::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketDeleted::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Ticket\App\Events\Admin\V1\TicketTypeUpdated::class => [
                // listeners
            ],
        ],
    ],
    'requests' => [
        RequestType::API->value => [
            'index' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketIndexRequest::class,
            'store' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketStoreRequest::class,
            'show' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketShowRequest::class,
            'update' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketUpdateRequest::class,
            'destroy' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Ticket\App\Http\Requests\Api\V1\TicketTypeUpdateRequest::class,
        ],
        RequestType::WEB->value => [
            'index' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketIndexRequest::class,
            'create' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketCreateRequest::class,
            'store' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketStoreRequest::class,
            'show' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketShowRequest::class,
            'edit' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketEditRequest::class,
            'update' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketUpdateRequest::class,
            'destroy' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Ticket\App\Http\Requests\Web\V1\TicketTypeUpdateRequest::class,
        ],
        RequestType::ADMIN->value => [
            'index' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketIndexRequest::class,
            'store' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketStoreRequest::class,
            'show' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketShowRequest::class,
            'update' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketUpdateRequest::class,
            'destroy' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Ticket\App\Http\Requests\Admin\V1\TicketTypeUpdateRequest::class,
        ],
    ],
    'controllers' => [
        RequestType::API->value => [
            'ticket' => \Callmeaf\Ticket\App\Http\Controllers\Api\V1\TicketController::class,
        ],
        RequestType::WEB->value => [
            'ticket' => \Callmeaf\Ticket\App\Http\Controllers\Web\V1\TicketController::class,
        ],
        RequestType::ADMIN->value => [
            'ticket' => \Callmeaf\Ticket\App\Http\Controllers\Admin\V1\TicketController::class,
        ],
    ],
    'routes' => [
        RequestType::API->value => [
            'prefix' => 'tickets',
            'as' => 'tickets.',
            'middleware' => [
                'auth:sanctum',
            ],
        ],
        RequestType::WEB->value => [
            'prefix' => 'tickets',
            'as' => 'tickets.',
            'middleware' => [
                'route_status:' . \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND,
            ],
        ],
        RequestType::ADMIN->value => [
            'prefix' => 'tickets',
            'as' => 'tickets.',
            'middleware' => [
                'auth:sanctum',
                'role:' . \Callmeaf\Role\App\Enums\RoleName::SUPER_ADMIN->value
            ],
        ],
    ],
    'enums' => [
         'status' => \Callmeaf\Ticket\App\Enums\TicketStatus::class,
         'type' => \Callmeaf\Ticket\App\Enums\TicketType::class,
         'subject' => \Callmeaf\Ticket\App\Enums\TicketSubject::class,
    ],
     'exports' => [
        RequestType::API->value => [
            'excel' => \Callmeaf\Ticket\App\Exports\Api\V1\TicketsExport::class,
        ],
        RequestType::WEB->value => [
            'excel' => \Callmeaf\Ticket\App\Exports\Web\V1\TicketsExport::class,
        ],
        RequestType::ADMIN->value => [
            'excel' => \Callmeaf\Ticket\App\Exports\Admin\V1\TicketsExport::class,
        ],
     ],
     'imports' => [
         RequestType::API->value => [
             'excel' => \Callmeaf\Ticket\App\Imports\Api\V1\TicketsImport::class,
         ],
         RequestType::WEB->value => [
             'excel' => \Callmeaf\Ticket\App\Imports\Web\V1\TicketsImport::class,
         ],
         RequestType::ADMIN->value => [
             'excel' => \Callmeaf\Ticket\App\Imports\Admin\V1\TicketsImport::class,
         ],
     ],
    "ref_code_length" => 5,
    "ref_code_prefix" => 'callmeaf-'
];
