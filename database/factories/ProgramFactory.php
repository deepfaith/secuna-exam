<?php

namespace Database\Factories;

use App\Constants\RecordStatusConstants;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->randomHtml,
            'pentesting_start_date' => time(),
            'pentesting_end_date' => time(),
            'user_id' => 1,
            'record_status' => RecordStatusConstants::STATUS[1]['value'],
            'image' => null,
        ];
    }
}
