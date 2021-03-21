<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name' => $this->faker->name,
          'email' => $this->faker->unique()->safeEmail,
          'subject' => $this->faker->sentence(1),
          'message' => $this->faker->text(100),
          'is_archive'=> random_int(0,1)
            //
        ];
    }
}
