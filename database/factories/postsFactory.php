<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class postsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title"=> $this->faker->sentence(5) ,
            "content"=> $this->faker->paragraph()
        ];
    }

    public function newTitle()
    {
        return $this->state([
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);
    }

}
