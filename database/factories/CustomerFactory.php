<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Address;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type=$this->faker->randomElement(['i','b']);//i->indiv
        $name= $type == 'i'? $this->faker->name() :$this->faker->company();
        return [
            'name'=>$name,
            'type'=>$type,
            'email'=>$this->faker->email(),
            'address'=>$this->faker->streetAddress(),
            'city'=>$this->faker->city(),
            'state'=>$this->faker->state(),
            'postal_code'=>Address::postcode()

            //
        ];
    }
}
