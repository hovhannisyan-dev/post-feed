<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $postIds = Post::all()->pluck('id');

        foreach ($users as $user) {
            $viewed = $postIds->random(rand(10, 50));

            foreach ($viewed as $postId) {
                PostView::updateOrCreate(
                    ['user_id' => $user->id, 'post_id' => $postId],
                    ['viewed_at' => now()->subDays(rand(0, 10))]
                );

                DB::table('posts')
                    ->where('id', $postId)
                    ->increment('views');
            }
        }
    }
}
