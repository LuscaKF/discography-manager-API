<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;

Route::prefix('albums')->group(function () {
    // Rotas para álbuns

    Route::get('/', [AlbumController::class, 'index']);
    Route::post('/', [AlbumController::class, 'store']);
    Route::get('/{albumId}', [AlbumController::class, 'show']);
    Route::put('/{albumId}', [AlbumController::class, 'update']);
    Route::delete('/{albumId}', [AlbumController::class, 'destroy']);
    Route::get('/search', [AlbumController::class, 'search']);


    // Rotas para faixas de álbuns

    Route::post('/{albumId}/tracks', [TrackController::class, 'store']);
    Route::get('/{albumId}/tracks', [TrackController::class, 'index']);
    Route::get('/{albumId}/tracks/{trackId}', [TrackController::class, 'show']);
    Route::put('/{albumId}/tracks/{trackId}', [TrackController::class, 'update']);
    Route::delete('/{albumId}/tracks/{trackId}', [TrackController::class, 'destroy']);
    Route::get('/{albumId}/tracks/search', [TrackController::class, 'search']);

});

