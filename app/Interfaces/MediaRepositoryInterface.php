<?php

namespace App\Interfaces;

interface MediaRepositoryInterface
{
    /**
     * Upload the media
     */
    public function uploadMedia(object $file, string $path): string;

    /**
     * Delete the media
     */
    public function deleteMedia(string $file): bool;
}
