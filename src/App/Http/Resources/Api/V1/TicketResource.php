<?php

namespace Callmeaf\Ticket\App\Http\Resources\Api\V1;

use Callmeaf\Base\App\Enums\DateTimeFormat;
use Callmeaf\Media\App\Repo\Contracts\MediaRepoInterface;
use Callmeaf\Ticket\App\Models\Ticket;
use Callmeaf\TicketReply\App\Repo\Contracts\TicketReplyRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Ticket $resource
 */
class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var MediaRepoInterface $mediaRepo
         */
        $mediaRepo = app(MediaRepoInterface::class);
        /**
         * @var TicketReplyRepoInterface $ticketReplyRepo
         */
        $ticketReplyRepo = app(TicketReplyRepoInterface::class);

        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return [
            'ref_code' => $this->ref_code,
            'sender_identifier' => $this->sender_identifier,
            'status' => $this->status,
            'status_text' => $this->statusText,
            'type' => $this->type,
            'type_text' => $this->typeText,
            'subject' => $this->subject,
            'subject_text' => $this->subjectText,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'created_at_text' => $this->createdAtText(DateTimeFormat::DATE_TIME),
            'updated_at' => $this->updated_at,
            'updated_at_text' => $this->updatedAtText(DateTimeFormat::DATE_TIME),
            'deleted_at' => $this->deleted_at,
            'deleted_at_text' => $this->deletedAtText(),
            'attachments' => $mediaRepo->toResourceCollection($this->whenLoaded('attachments')),
            'replies' => $ticketReplyRepo->toResourceCollection($this->whenLoaded('replies')),
            'can_answer' => $this->canAnswer(),
            'sender' => $userRepo->toResource($this->whenLoaded('sender')),
            'receiver' => $userRepo->toResource($this->whenLoaded('receiver')),
        ];
    }
}
