<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(10)->has(\App\Models\posts::factory(rand(4,8))->has(\App\Models\Comments::factory(rand(2,6))))->create();




        $this->call([
            tagsTableSeeder::class,
            postsTagsTableSeeder::class,
        ]);




        // $us =    \App\Models\User::factory(10)->hasPosts(3)->create();

        // \App\Models\posts::factory(50)->make()->each(function($post) use($us){
        //     $post->user_id = $us->random()->id;
        //     $post->save();
        // });


    }
}
