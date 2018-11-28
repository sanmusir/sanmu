<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make();

        //让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password'])->toArray();

        User::insert($user_array);

        //将1号赋予站长的角色
        $user = User::find(1);
        $user->assignRole('Founder');

        //将2号赋予管理员角色
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }
}
