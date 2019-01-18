<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //获取去除掉用户 ID 为 1 所有用户 ID 数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //关注除 ID 为 1 的用户
        $user->follow($follower_ids);

        //除了 ID 为 1 所用用户都关注 1 号用户
        foreach ($followers as $follower){
            $follower->follow($user_id);
        }

    }
}
