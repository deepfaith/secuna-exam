<?php

namespace Tests\Unit;

use App\Models\program;
use App\Models\User;
use App\Repositories\V1\ProgramRepository;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProgramTest extends TestCase
{
    /**
     * Check if public profile api is accessible or not.
     *
     * @return void
     */
    public function test_can_access_public_program_api()
    {
        $response = $this->get('/api/programs/view/all');

        $response->assertStatus(200);
    }

    /**
     * Check if program list is private. only user can see his programs.
     *
     * @return void
     */
    public function test_can_not_access_private_program_api()
    {
        $response = $this->get('/api/programs');

        $response->assertStatus(401);
    }

    /**
     * Test if program is creatable.
     *
     * @return void
     */
    public function test_can_create_program()
    {
        // Login the user first.
        Auth::login(User::where('email', 'admin@example.com')->first());
        $programRepository = new ProgramRepository();

        // First count total number of programs
        $totalprograms = Program::get('id')->count();

        $program = $programRepository->create([
            'title'       => 'Hello',
            'user_id'     => 1,
            'description' => 'Hello',
        ]);

        $this->assertDatabaseCount('programs', $totalprograms + 1);

        // Delete the program as need to keep it in database for other tests
        $program = Program::where('title', 'Hello')->where('description', 'Hello')->first();
        $program->delete();
    }
}
