<?php

namespace Callmeaf\Ticket\App\Models;

use Callmeaf\Base\App\Models\BaseModel;
use Callmeaf\Base\App\Models\Contracts\HasMedia;
use Callmeaf\Base\App\Traits\Model\HasDate;
use Callmeaf\Base\App\Traits\Model\HasSearch;
use Callmeaf\Base\App\Traits\Model\HasStatus;
use Callmeaf\Base\App\Traits\Model\HasType;
use Callmeaf\Base\App\Traits\Model\InteractsWithMedia;
use Callmeaf\Ticket\App\Enums\TicketStatus;
use Callmeaf\TicketReply\App\Repo\Contracts\TicketReplyRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Ticket extends BaseModel implements HasMedia
{
     use SoftDeletes,HasType,HasDate,InteractsWithMedia,HasSearch,HasStatus;

     protected $primaryKey = 'ref_code';
     protected $keyType = 'string';
     public $incrementing = false;
    protected $fillable = [
        'ref_code',
        'sender_identifier',
        'receiver_identifier',
        'status',
        'type',
        'subject',
        'title',
        'content'
    ];

    public static function configKey(): string
    {
        return 'callmeaf-ticket';
    }

    protected function casts(): array
    {
        return [
            ...(self::config()['enums'] ?? []),
        ];
    }

    public function scopeOfSubject(Builder $query, mixed $value): void
    {
        $query->where('subject', $value);
    }

    public function isSubject(mixed $value): bool
    {
        if ($this->subject instanceof \UnitEnum) {
            return $this->subject->value === $value;
        }
        return $this->subject === $value;
    }

    public function subjectText(): Attribute
    {
        return Attribute::get(fn() => \Base::enumCaseTranslator(
            \Base::getPackageNameFromModel(model: self::class),
            $this->subject,
        ));
    }

    public function scopeFromSender(Builder $query,mixed $value): void
    {
        $query->where('sender_identifier',$value);
    }

    public function scopeToReceiver(Builder $query,mixed $value): void
    {
        $query->where('receiver_identifier',$value);
    }

    public function sender(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,'sender_identifier',$userRepo->getModel()->getRouteKeyName());
    }

    public function receiver(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,'receiver_identifier',$userRepo->getModel()->getRouteKeyName());
    }

    public function attachments(): MorphMany
    {
        return $this->media()->where('collection_name',$this->mediaCollectionName());
    }

    public function replies(): HasMany
    {
        /**
         * @var TicketReplyRepoInterface $ticketReplyRepo
         */
        $ticketReplyRepo = app(TicketReplyRepoInterface::class);
        return $this->hasMany($ticketReplyRepo->getModel()::class,'ticket_ref_code');
    }

    public function senderIsSuperAdminOrAdmin(): bool
    {
        return userIsSuperAdmin(user: $this->sender) || userIsAdmin(user: $this->sender);
    }

    public function senderIsUser(): bool
    {
        return userIsUser(user: $this->sender);
    }

    public function receiverIsSuperAdminOrAdmin(): bool
    {
        return userIsSuperAdmin(user: $this->receiver) || userIsAdmin(user: $this->receiver);
    }

    public function receiverIsUser(): bool
    {
        return userIsUser(user: $this->receiver);
    }

    public function isCreatedBy($user = null): bool
    {
        $user ??= Auth::user();
        if(! $user) {
            return false;
        }
        return $user->getRouteKey() === $this->sender_identifier;
    }

    public function canAnswer(): bool
    {
        $status = $this->statuc;
        return $status != TicketStatus::CLOSED && $status != TicketStatus::ARCHIVED;
    }

    public function mediaCollectionName(): string
    {
        return 'attachments';
    }

    public function mediaDiskName(): string
    {
        return 'tickets';
    }

    public function maskedReceiverIdentifier(): Attribute
    {
        return Attribute::get(
            function() {
                $value = $this->receiver_identifier;
                if(userIsSuperAdmin() || request()->query('restrict_key') === \Base::config('restrict_route_middleware_key')) {
                    return $value;
                }

                return str($value)->mask('*',-15,5)->toString();
            }
        );
    }

    public function maskedSenderIdentifier(): Attribute
    {
        return Attribute::get(
            function() {
                $value = $this->sender_identifier;
                if(userIsSuperAdmin() || request()->query('restrict_key') === \Base::config('restrict_route_middleware_key')) {
                    return $value;
                }

                return str($value)->mask('*',-15,5)->toString();
            }
        );
    }

    public function searchParams(): array
    {
        return [
            [
               //
            ],
            [
                'status' => 'status',
                'type' => 'type',
                'subject' => 'subject',
                'created_from' => 'created_at',
                'created_to' => 'created_at',
            ],
        ];
    }
}
