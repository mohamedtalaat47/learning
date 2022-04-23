<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;

class tagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['sports','motors','news','fashion','education']);

        $tags->each(function ($tagName) {
            $tag = new Tags();
            $tag->name = $tagName;
            $tag->save();
        });
    }
}
