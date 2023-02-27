<?php

namespace Tests\Unit;

use App\Models\program;
use App\Models\ProgramReport;
use App\Models\User;
use App\Repositories\V1\ProgramReportRepository;
use App\Repositories\V1\ProgramRepository;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProgramReportTestTest extends TestCase
{
    /**
     * Check if public profile api is accessible or not.
     *
     * @return void
     */
    public function test_can_access_public_programreport_api()
    {
        $response = $this->get('/api/reports/view/all');

        $response->assertStatus(200);
    }

    /**
     * Check if program report list is private. only user can see his programs.
     *
     * @return void
     */
    public function test_can_not_access_private_programreport_api()
    {
        $response = $this->get('/api/reports');

        $response->assertStatus(401);
    }

    /**
     * Test if program report is creatable.
     *
     * @return void
     */
    public function test_can_create_programreport()
    {
        // Login the user first.
        Auth::login(User::where('email', 'admin@example.com')->first());
        $programRepository = new ProgramReportRepository();

        // First count total number of programs
        $totalprograms = ProgramReport::get('id')->count();

        $program = $programRepository->create([
            'title'       => 'Hello',
            'user_id'     => 1,
            'program_id'     => 1,
            'description' => 'Hello',
        ]);

        $this->assertDatabaseCount('program_reports', $totalprograms + 1);

        // Delete the program as need to keep it in database for other tests
        $program = ProgramReport::where('title', 'Hello')->where('description', 'Hello')->first();
        $program->delete();
    }
}
