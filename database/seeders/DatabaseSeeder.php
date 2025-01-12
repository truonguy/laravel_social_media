<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Reaction;
use App\Models\GroupUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản cố định
        $fixedUser = User::create([
            'name' => 'Truong Nguyen',
            'username' => 'truonguy123tx',
            'email' => 'truonguy123tx@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'cover_path' => null,
            'avatar_path' => null,
            'pinned_post_id' => null,
        ]);

        // Tạo 30 người dùng ngẫu nhiên
        $users = User::factory(30)->create();

        // Tạo 10 nhóm
        $groups = Group::factory(10)->create();

        // Tạo bài viết cho mỗi người dùng
        $users->each(function ($user) {
            Post::factory(40)->create([
                'user_id' => $user->id,
            ])->each(function ($post) {
                // Tạo comments cho mỗi bài viết
                Comment::factory(5)->create([
                    'post_id' => $post->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);

                // Tạo reactions cho mỗi bài viết
                Reaction::factory(8)->create([
                    'object_id' => $post->id,
                    'object_type' => 'post',
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);
            });
        });

        // Tạo 10 nhóm
        $groups = Group::factory(10)->create();

        // Tạo bài viết cho mỗi nhóm
        $groups->each(function ($group) {
            $groupUsers = User::inRandomOrder()->limit(10)->get();
            $groupUsers->each(function ($user) use ($group) {
                Post::factory(40)->create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                ])->each(function ($post) {
                    // Tạo comments cho mỗi bài viết
                    Comment::factory(5)->create([
                        'post_id' => $post->id,
                        'user_id' => User::inRandomOrder()->first()->id,
                    ]);

                    // Tạo reactions cho mỗi bài viết
                    Reaction::factory(8)->create([
                        'object_id' => $post->id,
                        'object_type' => 'post',
                        'user_id' => User::inRandomOrder()->first()->id,
                    ]);
                });
            });

            // Gán thành viên cho nhóm
            $groupUsers->each(function ($user) use ($group) {
                GroupUser::factory()->create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                    'role' => fake()->randomElement(['member', 'admin']),
                    'status' => fake()->randomElement(['approved', 'pending']),
                    'created_by' => User::inRandomOrder()->first()->id,
                    'created_at' => now(),
                ]);
            });
        });

        // Tạo followers và following cho mỗi người dùng
        $users->each(function ($user) use ($users) {
            $followers = $users->where('id', '!=', $user->id)->random(10);
            $followers->each(function ($follower) use ($user) {
                Follower::factory()->create([
                    'user_id' => $user->id,
                    'follower_id' => $follower->id,
                ]);

                Follower::factory()->create([
                    'user_id' => $follower->id,
                    'follower_id' => $user->id,
                ]);
            });
        });
    }
}