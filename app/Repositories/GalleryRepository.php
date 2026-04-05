<?php

namespace App\Repositories;

use App\Models\Gallery;

class GalleryRepository extends BaseRepository
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
}
