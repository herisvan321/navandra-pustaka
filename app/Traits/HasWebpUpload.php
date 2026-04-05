<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebpUpload
{
    /**
     * Upload an image and convert it to WebP format.
     */
    protected function uploadAndConvertWebp(UploadedFile $file, string $folder): string
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.webp';
        $path = $folder . '/' . $filename;
        
        $image = null;
        $extension = strtolower($file->getClientOriginalExtension());
        
        if ($extension === 'jpg' || $extension === 'jpeg') {
            $image = imagecreatefromjpeg($file->getRealPath());
        } elseif ($extension === 'png') {
            $image = imagecreatefrompng($file->getRealPath());
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } elseif ($extension === 'webp') {
            $image = imagecreatefromwebp($file->getRealPath());
        }
        
        if ($image) {
            ob_start();
            imagewebp($image, null, 80);
            $webpData = ob_get_clean();
            Storage::disk('public')->put($path, $webpData);
            imagedestroy($image);
            return $path;
        }

        // Fallback if conversion fails
        return $file->store($folder, 'public');
    }
}
