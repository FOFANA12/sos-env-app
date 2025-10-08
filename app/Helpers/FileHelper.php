<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Upload a file to storage and return its storage name.
     *
     * @param UploadedFile $file
     * @param string $directory Ex: 'avatars', 'items', etc.
     * @param string|null $name Optional filename (without extension)
     * @return string Stored filename (e.g., 34f...c2.png)
     */
    public static function upload(UploadedFile $file, string $directory = 'uploads', ?string $name = null): string
    {
        $filename = ($name ?? Str::uuid()) . '.' . $file->getClientOriginalExtension();
        $disk = config('filesystems.default', 'public');

        Storage::disk($disk)->putFileAs($directory, $file, $filename);

        return $filename;
    }

    /**
     * Generate a public or signed URL for a stored file.
     *
     * @param string|null $path Relative path (e.g. 'uploads/avatars/abc.jpg')
     * @param int $expiration Minutes for temporary URL
     * @return string|null
     */
    public static function url(?string $path, int $expiration = 5): ?string
    {
        if (blank($path)) {
            return null;
        }

        $diskName = config('filesystems.default', 'public');
        $disk = Storage::disk($diskName);

        if (! $disk->exists($path)) {
            return null;
        }

        if ($diskName === 's3') {
            return $disk->temporaryUrl($path, now()->addMinutes($expiration));
        }

        return $disk->url($path);
    }


    /**
     * Delete a file from storage if it exists.
     *
     * @param string|null $path Relative path (e.g. 'uploads/items/abc.png')
     * @return bool
     */
    public static function delete(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        $disk = Storage::disk(config('filesystems.default', 'public'));

        if ($disk->exists($path)) {
            return $disk->delete($path);
        }

        return false;
    }
}
