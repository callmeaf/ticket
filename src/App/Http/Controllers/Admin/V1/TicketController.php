<?php

namespace Callmeaf\Ticket\App\Http\Controllers\Admin\V1;

use Callmeaf\Base\App\Http\Controllers\Admin\V1\AdminController;
use Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TicketController extends AdminController implements HasMiddleware
{
    public function __construct(protected TicketRepoInterface $ticketRepo)
    {
        parent::__construct($this->ticketRepo->config);
    }

    public static function middleware(): array
    {
        return [
           //
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->ticketRepo->latest()->search()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return $this->ticketRepo->create(data: $this->request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->ticketRepo->builder(fn(Builder $query) => $query->with([
            'sender' => fn(BelongsTo $query) => $query->select(['id','email','first_name','last_name'])->with(['image']),
            'receiver' => fn(BelongsTo $query) => $query->select(['id','email','first_name','last_name'])->with(['image']),
            'attachments',
            'replies.attachments'
        ]))->findById(value: $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        return $this->ticketRepo->update(id: $id, data: $this->request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->ticketRepo->delete(id: $id);
    }

    public function statusUpdate(string $id)
    {
        return $this->ticketRepo->update(id: $id, data: $this->request->validated());
    }

    public function typeUpdate(string $id)
    {
        return $this->ticketRepo->update(id: $id, data: $this->request->validated());
    }

    public function subjectUpdate(string $id)
    {
        return $this->ticketRepo->update(id: $id, data: $this->request->validated());
    }

    public function trashed()
    {
        return $this->ticketRepo->trashed()->latest()->search()->paginate();
    }

    public function restore(string $id)
    {
        return $this->ticketRepo->restore(id: $id);
    }

    public function forceDestroy(string $id)
    {
        return $this->ticketRepo->forceDelete(id: $id);
    }
}
