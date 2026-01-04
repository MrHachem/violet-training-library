<?php

namespace App\Services\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileService
{
    protected ImageManager $manager;

    public function __construct() {
        $this->manager = new ImageManager(new Driver());
    }

    public function storePublicImage(UploadedFile $file, string $folder, int $width = 300): string
    {
        $filename = $file->hashName();
        $path = $folder . '/' . $filename;

        $image = $this->manager->read($file);

        $image->scale(width: $width);

        $encoded = $image->toJpeg(quality: 80);

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    public function deleteFile(string $disk, string $path): void
    {
        try {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        } catch (\Exception $e) {
            Log::warning("Failed to delete file [$path] on disk [$disk]: " . $e->getMessage());
        }
    }
}