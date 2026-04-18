<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Store an uploaded image as a resized WebP file.
     *
     * Falls back to plain storage if GD is unavailable or the source
     * format is not supported, so the upload never fails silently.
     *
     * @param  UploadedFile  $file
     * @param  string        $folder   e.g. 'products', 'services', 'pages'
     * @param  int           $maxWidth  Maximum width in pixels (height scales proportionally)
     * @param  int           $quality   WebP quality 1–100
     * @return string        Storage-relative path (suitable for Storage::disk('public'))
     */
    public static function store(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1920,
        int $quality = 82
    ): string {
        // If GD is not loaded, fall back to plain storage
        if (!extension_loaded('gd')) {
            return $file->store($folder, 'public');
        }

        $mime = $file->getMimeType();
        $src  = self::createSourceImage($file->getRealPath(), $mime);

        // If format not supported by GD, fall back gracefully
        if ($src === null) {
            return $file->store($folder, 'public');
        }

        [$origW, $origH] = [imagesx($src), imagesy($src)];

        // Resize only if wider than maxWidth
        if ($origW > $maxWidth) {
            $newW = $maxWidth;
            $newH = (int) round($origH * ($maxWidth / $origW));
            $dst  = imagecreatetruecolor($newW, $newH);

            // Preserve transparency
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
            imagedestroy($src);
            $src = $dst;
        }

        $filename = Str::uuid() . '.webp';
        $path     = $folder . '/' . $filename;
        $tmpPath  = sys_get_temp_dir() . '/' . $filename;

        imagewebp($src, $tmpPath, $quality);
        imagedestroy($src);

        Storage::disk('public')->put($path, file_get_contents($tmpPath));
        @unlink($tmpPath);

        return $path;
    }

    private static function createSourceImage(string $realPath, string $mime): ?\GdImage
    {
        return match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($realPath),
            'image/png'  => @imagecreatefrompng($realPath),
            'image/webp' => @imagecreatefromwebp($realPath),
            'image/gif'  => @imagecreatefromgif($realPath),
            default      => null,
        };
    }
}
