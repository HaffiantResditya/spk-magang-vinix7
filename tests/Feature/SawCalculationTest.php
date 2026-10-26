<?php

namespace Tests\Feature;

use App\Models\ApplicantAnswer;
use App\Models\Criterion;
use App\Models\Division;
use App\Models\MatrixWeight;
use App\Models\Question;
use App\Models\User;
use App\Services\SawCalculationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SawCalculationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_database_has_seeded_master_data(): void
    {
        $this->assertEquals(14, Division::count());
        $this->assertEquals(7, Criterion::count());
        $this->assertEquals(18, Question::count());
        $this->assertEquals(98, MatrixWeight::count());
    }

    public function test_saw_engine_calculates_top_3_recommendations(): void
    {
        $user = User::where('email', 'pelamar.vinix7@gmail.com')->first();
        $this->assertNotNull($user);

        // Seed sample answers with higher scores for Web (C1)
        $c1 = Criterion::where('code', 'C1')->first();
        foreach ($c1->questions as $q) {
            ApplicantAnswer::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $q->id],
                ['score_value' => 100]
            );
        }

        $service = app(SawCalculationService::class);
        $result = $service->calculate($user);

        $this->assertArrayHasKey('top3', $result);
        $this->assertCount(3, $result['top3']);
        $this->assertEquals(1, $result['top3'][0]['rank']);

        // Since C1 is scored 100%, Web & UIUX Developer should rank near the top!
        $this->assertGreaterThan(50.0, $result['top3'][0]['final_score']);
    }

    public function test_routes_are_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
