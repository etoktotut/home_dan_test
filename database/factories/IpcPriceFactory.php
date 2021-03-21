<?php

namespace Database\Factories;

use App\Models\IpcPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class IpcPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IpcPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'rrc_price'=>$this->faker->randomElement([7230.45,6500,9290,10390,14800,26500,189,23000])
        ];
    }
}
