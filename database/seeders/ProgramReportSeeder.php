<?php

namespace Database\Seeders;

use App\Constants\RecordStatusConstants;
use App\Constants\RequestStatusConstants;
use App\Constants\SeverityConstant;
use App\Models\ProgramReport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_reports')->delete();
        $data = [
            [
                'title' => 'Program Report 1',
                'description' => 'Program Report 1 Description',
                'user_id' => 1,
                'program_id' => 1,
                'severity' => SeverityConstant::LEVELS[0]['value'],
                'request_status' => RequestStatusConstants::STATUS[0]['value'],
                'record_status' => RecordStatusConstants::STATUS[1]['value'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        ProgramReport::insert($data);
    }
}
