<?php

namespace Database\Factories;

use App\Constants\RecordStatusConstants;
use App\Constants\RequestStatusConstants;
use App\Constants\SeverityConstant;
use App\Models\ProgramReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProgramReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'user_id' => 1,
            'program_id' => 1,
            'severity' => SeverityConstant::LEVELS[0]['value'],
            'request_status' => RequestStatusConstants::STATUS[0]['value'],
            'record_status' => RecordStatusConstants::STATUS[1]['value'],
        ];
    }
}
