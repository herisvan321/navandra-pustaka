<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends BaseRepository
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function getByCategory(string $category)
    {
        return $this->model->where('category', $category)->get();
    }

    public function search(string $query)
    {
        return $this->model->where('title', 'LIKE', "%$query%")
                           ->orWhere('author', 'LIKE', "%$query%")
                           ->get();
    }
}
