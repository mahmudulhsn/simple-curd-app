<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\MediaRepositoryInterface;

class MediaRepository implements MediaRepositoryInterface
{
    /**
     * Upload the media
     */
    public function uploadMedia(object $file, string $path): string
    {
        return $file->storeAs($path, str_replace('-', ' ', $file->getClientOriginalName()) . '.' . Str::random(56) . '.' . $file->getClientOriginalExtension());
    }

    /**
     * Delete the media
     */
    public function deleteMedia(string $file): bool
    {
        return Storage::delete($file);
    }
}
