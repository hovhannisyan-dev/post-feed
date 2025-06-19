<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PostView;

class PostViewRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return PostView::class;
    }
}
