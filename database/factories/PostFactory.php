<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));
        return [
            //
            'titulo'=>ucfirst($this->faker->unique()->words(random_int(2,4),true)),
            'descripcion'=>$this->faker->text(),
            'categoria'=>random_int(1,6),
            'precio'=>$this->faker->randomFloat(2,1,999),
            'user_id'=>User::all()->random()->id,
            'imagen'=>'posts/'.$this->faker->picsum('public/storage/posts',640,480,null,false),
            'estado'=>random_int(1,2)
        ];
    }
}
