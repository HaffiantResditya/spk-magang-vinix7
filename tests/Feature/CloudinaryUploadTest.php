<?php

namespace Tests\Feature;

use App\Models\ApplicantProfile;
use App\Models\User;
use App\Services\CloudinaryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CloudinaryUploadTest extends TestCase
{
    public function test_cv_url_accessor_handles_cloudinary_url(): void
    {
        $profile = new ApplicantProfile([
            'cv_path' => 'https://res.cloudinary.com/fwc9kf3e/image/upload/v1793011933/spk-magang-vinix7/cvs/cv_test.pdf'
        ]);

        $this->assertEquals(
            'https://res.cloudinary.com/fwc9kf3e/image/upload/v1793011933/spk-magang-vinix7/cvs/cv_test.pdf',
            $profile->cv_url
        );
    }

    public function test_cv_url_accessor_handles_local_fallback_storage(): void
    {
        $profile = new ApplicantProfile([
            'cv_path' => 'cv_uploads/sample_local.pdf'
        ]);

        $this->assertEquals(
            asset('storage/cv_uploads/sample_local.pdf'),
            $profile->cv_url
        );
    }

    public function test_cloudinary_service_resolves_and_configured(): void
    {
        $service = app(CloudinaryService::class);
        $this->assertInstanceOf(CloudinaryService::class, $service);
    }
}
