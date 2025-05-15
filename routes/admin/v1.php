<?php

use Illuminate\Support\Facades\Route;

[
    $controllers,
    $prefix,
    $as,
    $middleware,
] = Base::getRouteConfigFromRepo(repo: \Callmeaf\Ticket\App\Repo\Contracts\TicketRepoInterface::class);

Route::apiResource($prefix, $controllers['ticket'])->middleware($middleware);
 Route::prefix($prefix)->as($as)->middleware($middleware)->controller($controllers['ticket'])->group(function () {
     Route::get('trashed/list', 'trashed');
     Route::prefix('{ticket}')->group(function () {
         Route::patch('/status', 'statusUpdate');
         Route::patch('/type', 'typeUpdate');
         Route::patch('/subject', 'subjectUpdate');
         Route::patch('/restore', 'restore');
         Route::delete('/force', 'forceDestroy');
     });
 });
