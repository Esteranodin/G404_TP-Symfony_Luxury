<?php

namespace App\Service;

use App\Entity\Candidate;
use App\Interfaces\FileHandlerInterface;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHandler implements FileHandlerInterface
{
    private FileUploader $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    
    public function handleFiles(Candidate $candidate, array $files): void
    {
        foreach ($files as $field => $file) {
            if ($file instanceof UploadedFile) {
                $methodName = 'set' . ucfirst($field);
                $fileName = $this->fileUploader->upload($file, $candidate, $field, $this->getUploadDirectory($field));
                if (method_exists($candidate, $methodName)) {
                    $candidate->$methodName($fileName);
                }
            }
        }
    }

    private function getUploadDirectory(string $field): string
    {
        return match ($field) {
            'profilePicPath' => 'profile_pictures',
            'passportPath' => 'passport_files',
            'cvPath' => 'cv_files',
            default => 'uploads',
        };
    }
}