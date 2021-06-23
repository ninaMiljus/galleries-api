<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'source' => 'https://upload.wikimedia.org/wikipedia/commons/2/27/Galerija_Sava_%C5%A0umanovi%C4%87_11.JPG',
            'gallery_id' => Gallery::inRandomOrder()->first()->id
        ];
    }
}
