<?php

namespace App\Services;

use App\Repositories\GalleryRepository;
use App\Traits\HasWebpUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryService extends BaseService
{
    use HasWebpUpload;

    public function __construct(GalleryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createGallery(array $data, ?UploadedFile $image = null)
    {
        if ($image) {
            $data['image_path'] = $this->uploadAndConvertWebp($image, 'gallery');
        }
        return $this->create($data);
    }

    public function updateGallery($id, array $data, ?UploadedFile $image = null)
    {
        $gallery = $this->getById($id);
        if ($image) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $this->uploadAndConvertWebp($image, 'gallery');
        }
        return $this->update($id, $data);
    }
}
