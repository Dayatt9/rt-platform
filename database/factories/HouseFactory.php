<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<House> */
class HouseFactory extends Factory
{
    public function definition(): array { return ['tenant_id'=>Tenant::factory(),'house_number'=>$this->faker->unique()->bothify('A-##'),'address'=>$this->faker->address(),'latitude'=>null,'longitude'=>null,'status'=>'active']; }
}
