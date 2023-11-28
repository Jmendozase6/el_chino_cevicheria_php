<?php

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

require_once __DIR__ . '/../../datasource/constants.php';

class CloudinaryService
{
    public function __construct()
    {
        Configuration::instance([
                'cloud' => [
                    'cloud_name' => CLOUDINARY_CLOUD_NAME,
                    'api_key' => CLOUDINARY_API_KEY,
                    'api_secret' => CLOUDINARY_API_SECRET],
                'url' => [
                    'secure' => true]
            ]
        );
    }

    public function deleteImage($photo, $folder): void
    {
        (new UploadApi())->destroy($photo,
            [
                'folder' => $folder,
                'invalidate' => TRUE,
            ]);
    }

    public function uploadImage($photo, $folder, $width = 250, $height = 150): string
    {
        try {
            $upload = (new UploadApi())->upload($photo,
                [
                    'folder' => $folder,
                    'resource_type' => 'auto',
                    'overwrite' => TRUE,
                    'transformation' => [
                        'width' => $width,
                        'height' => $height,
                    ],
                ]);
            return $upload['secure_url'];
        } catch (ApiError $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}