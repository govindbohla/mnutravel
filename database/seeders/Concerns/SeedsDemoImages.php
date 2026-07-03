<?php

namespace Database\Seeders\Concerns;

use App\Services\ImageUploadService;
use Illuminate\Http\UploadedFile;

/**
 * Feeds the committed demo images under database/seeders/demo-assets/
 * through the same ImageUploadService real admin uploads use, so
 * seeded records end up with properly resized/stored images instead
 * of broken paths. Silently returns null if the source file isn't
 * present, so seeding still works on a machine that only has the
 * repo (no demo-assets required to exist for the app to function).
 */
trait SeedsDemoImages
{
    protected function seedImage(string $relativeSourcePath, string $storageDirectory): ?string
    {
        $sourcePath = database_path('seeders/demo-assets/'.ltrim($relativeSourcePath, '/'));

        if (! is_file($sourcePath)) {
            return null;
        }

        $uploadedFile = new UploadedFile(
            $sourcePath,
            basename($sourcePath),
            mime_content_type($sourcePath) ?: null,
            null,
            true // "test mode" - skip is_uploaded_file() checks for a local file.
        );

        return app(ImageUploadService::class)->upload($uploadedFile, $storageDirectory);
    }
}
