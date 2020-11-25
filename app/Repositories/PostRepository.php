<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }
}
