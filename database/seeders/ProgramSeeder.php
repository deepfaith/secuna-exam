<?php

namespace Database\Seeders;

use App\Constants\RecordStatusConstants;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->delete();
        $data = [
            [
                'title' => 'Program 1',
                'description' => 'Program 1 Description',
                'image' => null,
                'record_status' => RecordStatusConstants::STATUS[1]['value'],
                'user_id' => 1,
                'pentesting_start_date' => time(),
                'pentesting_end_date' => time(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Program 2',
                'description' => 'Program 2 Description',
                'image' => null,
                'record_status' => RecordStatusConstants::STATUS[1]['value'],
                'user_id' => 1,
                'pentesting_start_date' => time(),
                'pentesting_end_date' => time(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Program 3',
                'description' => 'Program 3 Description',
                'image' => null,
                'record_status' => RecordStatusConstants::STATUS[1]['value'],
                'user_id' => 1,
                'pentesting_start_date' => time(),
                'pentesting_end_date' => time(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Program::insert($data);

        // Testing Dummy Programs
        Program::factory(100)->create();
    }
}
