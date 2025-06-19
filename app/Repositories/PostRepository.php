<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function incrementViews(int $id): void
    {
        $this->getQuery()->where('id', $id)->increment('views');
    }
}
