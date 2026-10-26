<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected Cloudinary $cloudinary;
    protected string $folder;

    public function __construct()
    {
        $cloudinaryUrl = config('cloudinary.cloud_url') ?: env('CLOUDINARY_URL');

        if (!empty($cloudinaryUrl)) {
            $this->cloudinary = new Cloudinary($cloudinaryUrl);
        } else {
            $this->cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name', env('CLOUDINARY_CLOUD_NAME')),
                    'api_key'    => config('cloudinary.api_key', env('CLOUDINARY_API_KEY')),
                    'api_secret' => config('cloudinary.api_secret', env('CLOUDINARY_API_SECRET')),
                ],
                'url' => [
                    'secure' => true,
                ],
            ]);
        }

        // Configure Guzzle client with SSL verification handling for Windows environments
        $verifySsl = config('cloudinary.verify_ssl', env('CLOUDINARY_VERIFY_SSL', false));
        $this->cloudinary->setHttpClient(new \GuzzleHttp\Client([
            'verify' => $verifySsl,
        ]));

        $this->folder = config('cloudinary.folder', 'spk-magang-vinix7/cvs');
    }

    /**
     * Upload a CV file (PDF) to Cloudinary into isolated project folder.
     *
     * @param UploadedFile|string $file
     * @param int|string $userId
     * @return string Secure HTTPS URL of the uploaded document
     */
    public function uploadCv($file, $userId): string
    {
        $filePath = $file instanceof UploadedFile ? $file->getRealPath() : $file;
        $publicId = 'cv_user_' . $userId . '_' . time();

        $response = $this->cloudinary->uploadApi()->upload($filePath, [
            'folder'        => $this->folder,
            'public_id'     => $publicId,
            'resource_type' => 'auto',
            'overwrite'     => true,
            'tags'          => ['spk-magang-vinix7', 'applicant-cv'],
        ]);

        return $response['secure_url'];
    }
}
