<?php

namespace Callmeaf\Ticket\App\Models;

use Callmeaf\Base\App\Models\BaseModel;
use Callmeaf\Base\App\Models\Contracts\HasMedia;
use Callmeaf\Base\App\Traits\Model\HasDate;
use Callmeaf\Base\App\Traits\Model\HasSearch;
use Callmeaf\Base\App\Traits\Model\HasType;
use Callmeaf\Base\App\Traits\Model\InteractsWithMedia;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Ticket extends BaseModel implements HasMedia
{
     use SoftDeletes,HasType,HasDate,HasUlids,InteractsWithMedia,HasSearch;

    protected $fillable = [
        'sender_email',
        'receiver_email',
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
        $query->where('sender_email',$value);
    }

    public function scopeToReceiver(Builder $query,mixed $value): void
    {
        $query->where('receiver_email',$value);
    }

    public function sender(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,'sender_email','email');
    }

    public function receiver(): BelongsTo
    {
        /**
         * @var UserRepoInterface $userRepo
         */
        $userRepo = app(UserRepoInterface::class);
        return $this->belongsTo($userRepo->getModel()::class,'receiver_email','email');
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

        return $user?->email === $this->sender_email;
    }

    public function mediaCollectionName(): string
    {
        return 'ticket';
    }

    public function mediaDiskName(): string
    {
        return 'tickets';
    }

    public function searchParams(): array
    {
        return [
            [
                'status' => 'status',
                'type' => 'type',
                'subject' => 'subject',
            ],
            [
                'created_from' => 'created_at',
                'created_to' => 'created_at',
            ],
        ];
    }
}
