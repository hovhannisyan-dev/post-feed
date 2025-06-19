<?php

declare(strict_types=1);

namespace App\Managers;

use App\Repositories\PostRepository;
use App\Repositories\PostViewRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;
use Illuminate\Pagination\LengthAwarePaginator;

class PostManager
{
    public function __construct(
        protected PostRepository $postRepository,
        protected PostViewRepository $postViewRepository,
    ) {
    }

    /**
     * @param int      $userId
     * @param int|null $perPage
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFeedByUserId(int $userId, ?int $perPage = 15): LengthAwarePaginator
    {
        $viewedIds = $this->postViewRepository->findWhere(['user_id' => $userId])->pluck('post_id');

        return $this->postRepository->getQuery()
            ->whereNotIn('id', $viewedIds)
            ->where('views', '<', 1000)
            ->orderByDesc('hotness')
            ->paginate($perPage);
    }

    /**
     * @param int $userId
     * @param int $postId
     *
     * @return void
     */
    public function markViewed(int $userId, int $postId): void
    {
        DB::beginTransaction();

        try {
            $this->postViewRepository->updateOrCreate(
                ['user_id' => $userId, 'post_id' => $postId],
                ['viewed_at' => now()],
            );

            $this->postRepository->incrementViews($postId);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Failed to mark post as viewed', ['exception' => $e]);
            throw new RuntimeException('Failed to mark post as viewed.');
        }
    }
}
