<?php

namespace Callmeaf\Ticket\App\Http\Resources\Admin\V1;

use Callmeaf\Media\App\Repo\Contracts\MediaRepoInterface;
use Callmeaf\Ticket\App\Models\Ticket;
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
        return [
            'id' => $this->id,
            'sender_email' => $this->sender_email,
            'receiver_email' => $this->receiver_email,
            'status' => $this->status,
            'status_text' => $this->statusText,
            'type' => $this->type,
            'type_text' => $this->typeText,
            'subject' => $this->subject,
            'subject_text' => $this->subjectText,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'created_at_text' => $this->createdAtText(),
            'updated_at' => $this->updated_at,
            'updated_at_text' => $this->updatedAtText(),
            'deleted_at' => $this->deleted_at,
            'deleted_at_text' => $this->deletedAtText(),
            'media' => $mediaRepo->toResourceCollection($this->whenLoaded('media'))
        ];
    }
}
