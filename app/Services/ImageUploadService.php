<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ImageUploadService
{
    protected ?ImageManager $manager = null;

    /**
     * Resize (if needed), optimize, and store an uploaded image on the
     * public disk. Returns the stored relative path.
     */
    public function upload(UploadedFile $file, string $directory, int $maxWidth = 1600, ?string $replacePath = null): string
    {
        $filename = Str::uuid()->toString().'.'.($file->getClientOriginalExtension() ?: 'jpg');
        $path = trim($directory, '/').'/'.$filename;

        $image = $this->manager()->read($file->getRealPath());

        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        Storage::disk('public')->put($path, (string) $image->encode());

        if ($replacePath) {
            $this->delete($replacePath);
        }

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * The GD driver is only constructed on first actual use, so pages that
     * never touch an image upload aren't affected if GD/Imagick isn't
     * available on a given environment.
     */
    protected function manager(): ImageManager
    {
        return $this->manager ??= ImageManager::gd();
    }
}
