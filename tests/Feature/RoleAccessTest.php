<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_superadmin_can_access_superadmin_dashboard_and_matrix_weights(): void
    {
        $superadmin = User::where('email', 'superadmin@vinix.id')->first();
        $this->assertNotNull($superadmin);

        $response = $this->actingAs($superadmin)->get('/superadmin/dashboard');
        $response->assertStatus(200);

        $response = $this->actingAs($superadmin)->get('/superadmin/matrix-weights');
        $response->assertStatus(200);

        $response = $this->actingAs($superadmin)->get('/superadmin/divisions');
        $response->assertStatus(200);

        $response = $this->actingAs($superadmin)->get('/superadmin/criteria');
        $response->assertStatus(200);
    }

    public function test_hrd_can_access_hrd_dashboard_and_applicants(): void
    {
        $hrd = User::where('email', 'hrd@vinix.id')->first();
        $this->assertNotNull($hrd);

        $response = $this->actingAs($hrd)->get('/hrd/dashboard');
        $response->assertStatus(200);

        $response = $this->actingAs($hrd)->get('/hrd/applicants');
        $response->assertStatus(200);
    }

    public function test_applicant_can_access_applicant_dashboard_and_assessment(): void
    {
        $applicant = User::where('email', 'pelamar@vinix.id')->first();
        $this->assertNotNull($applicant);

        $response = $this->actingAs($applicant)->get('/applicant/dashboard');
        $response->assertStatus(200);

        $response = $this->actingAs($applicant)->get('/applicant/assessment');
        $response->assertStatus(200);

        $response = $this->actingAs($applicant)->get('/applicant/profile');
        $response->assertStatus(200);
    }

    public function test_applicant_cannot_access_superadmin_or_hrd(): void
    {
        $applicant = User::where('email', 'pelamar@vinix.id')->first();
        $this->assertNotNull($applicant);

        $response = $this->actingAs($applicant)->get('/superadmin/dashboard');
        $response->assertRedirect(route('applicant.dashboard'));

        $response = $this->actingAs($applicant)->get('/hrd/dashboard');
        $response->assertRedirect(route('applicant.dashboard'));
    }
}
