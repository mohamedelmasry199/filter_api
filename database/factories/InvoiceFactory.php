<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status=$this->faker->randomElement(['b','p','v']);
        return [
            'customer_id'=>Customer::factory(),
            'amount'=>$this->faker->numberBetween(1,20000),
            'status'=>$status, //billed paid void
            'billed_dated'=>$this->faker->dateTimeThisDecade(),
            'paid_dated'=>$status=='p'? $this->faker->dateTimeThisDecade():null
            //
        ];
    }
}
