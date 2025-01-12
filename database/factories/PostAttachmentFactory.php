<?php
use App\Models\PostAttachment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostAttachmentFactory extends Factory
{
    protected $model = PostAttachment::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'name' => $this->faker->word(),
            'path' => $this->faker->word(),
            'mime' => 'image/jpeg',
            'size' => $this->faker->numberBetween(1000, 5000),
            'created_by' => $this->faker->randomDigitNotNull,
        ];
    }
}
