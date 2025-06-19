<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/feed', [PostController::class, 'feed']);
Route::post('/mark-viewed', [PostController::class, 'markViewed']);
