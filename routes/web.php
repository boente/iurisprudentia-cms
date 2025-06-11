<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/relay/{path}', function ($path) {
    $pathParts = explode('/', $path, 2);

    if (count($pathParts) < 2) {
        abort(404);
    }

    $diskName = 'assets_'.$pathParts[0];
    $filePath = $pathParts[1];

    $disk = Storage::disk($diskName);

    if (! $disk->exists($filePath)) {
        abort(404);
    }

    $mimeType = $disk->mimeType($filePath);
    $fileSize = $disk->size($filePath);

    return response()->stream(function () use ($disk, $filePath) {
        $stream = $disk->readStream($filePath);
        fpassthru($stream);
        fclose($stream);
    }, 200, [
        'Content-Type' => $mimeType,
        'Content-Length' => $fileSize,
    ]);
})->where('path', '.*');
