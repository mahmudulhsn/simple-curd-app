<?php

namespace App\Services;

use App\Interfaces\MediaRepositoryInterface;

class MediaService
{
    protected $mediaRepository;

    /**
     * MediaService constructor.
     */
    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Upload media
     */
    public function uploadMedia(object $file, string $path): string
    {
        return $this->mediaRepository->uploadMedia($file, $path);
    }

    /**
     * Delete media
     */
    public function deleteMedia(string $file): string
    {
        return $this->mediaRepository->deleteMedia($file);
    }
}
