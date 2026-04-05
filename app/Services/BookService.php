<?php

namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Traits\HasWebpUpload;

class BookService extends BaseService
{
    use HasWebpUpload;

    public function __construct(BookRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createBook(array $data, ?UploadedFile $cover = null)
    {
        if ($cover) {
            $data['cover_image'] = $this->uploadAndConvertWebp($cover, 'books');
        }
        return $this->create($data);
    }

    public function updateBook($id, array $data, ?UploadedFile $image = null)
    {
        $book = $this->getById($id);
        if ($image) {
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $this->uploadAndConvertWebp($image, 'books');
        }
        return $this->update($id, $data);
    }

}
