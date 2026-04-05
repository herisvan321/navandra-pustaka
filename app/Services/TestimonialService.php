<?php

namespace App\Services;

use App\Repositories\TestimonialRepository;
use App\Traits\HasWebpUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TestimonialService extends BaseService
{
    use HasWebpUpload;

    public function __construct(TestimonialRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createTestimonial(array $data, ?UploadedFile $avatar = null)
    {
        if ($avatar) {
            $data['avatar_path'] = $this->uploadAndConvertWebp($avatar, 'testimonials');
        }
        return $this->create($data);
    }

    public function updateTestimonial($id, array $data, ?UploadedFile $avatar = null)
    {
        $testimonial = $this->getById($id);
        if ($avatar) {
            if ($testimonial->avatar_path && Storage::disk('public')->exists($testimonial->avatar_path)) {
                Storage::disk('public')->delete($testimonial->avatar_path);
            }
            $data['avatar_path'] = $this->uploadAndConvertWebp($avatar, 'testimonials');
        }
        return $this->update($id, $data);
    }
}
