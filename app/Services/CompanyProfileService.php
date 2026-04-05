<?php

namespace App\Services;

use App\Repositories\CompanyProfileRepository;
use App\Models\CompanyProfile;
use App\Traits\HasWebpUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyProfileService extends BaseService
{
    use HasWebpUpload;

    public function __construct(CompanyProfileRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get the single company profile record.
     */
    public function getProfile()
    {
        return $this->getById(1) ?: CompanyProfile::create(['id' => 1, 'name' => 'Nevandra Pustaka', 'email' => 'contact@nevandra.com']);
    }

    /**
     * Update site profile.
     */
    public function updateProfile(array $data, ?UploadedFile $logo = null)
    {
        $profile = $this->getProfile();
        if ($logo) {
            if ($profile->logo_path) {
                Storage::disk('public')->delete($profile->logo_path);
            }
            $data['logo_path'] = $this->uploadAndConvertWebp($logo, 'profile');
        }
        return $this->update(1, $data);
    }
}
