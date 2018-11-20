<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids =  User::all()->pluck('id')->toArray();
        $topic_ids = Topic::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        for($i=1;$i<6;$i++){
            foreach ($user_ids as $v){
                $data['user_id'] = $v;
                $data['topic_id'] = $faker->randomElement($topic_ids);
                Favorite::insert($data);
            }
        }
    }
}
