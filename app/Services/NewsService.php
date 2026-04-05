<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Traits\HasWebpUpload;
use Illuminate\Support\Str;

class NewsService extends BaseService
{
    use HasWebpUpload;

    public function __construct(NewsRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createNews(array $data, ?UploadedFile $image = null)
    {
        if ($image) {
            $data['image_path'] = $this->uploadAndConvertWebp($image, 'news');
        }
        $data['slug'] = Str::slug($data['title']);
        return $this->create($data);
    }

    public function updateNews($id, array $data, ?UploadedFile $image = null)
    {
        $news = $this->getById($id);
        if ($image) {
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }
            $data['image_path'] = $this->uploadAndConvertWebp($image, 'news');
        }
        
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        return $this->update($id, $data);
    }

}
