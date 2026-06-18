<?php

declare(strict_types=1);

namespace RPWebDevelopment\HasImageLaravel\Dto;

use Illuminate\Http\UploadedFile;

class ImageDetails
{
    public array $imageFields = ['image'];
    public string $imageFolder = 'images';
    public string $storageDisk = 'public';
    public bool $maintainFilename = false;

    public static function create(
        string $imageDirectory = 'images',
        array $imageFields = ['image'],
        ?string $storageDisk = null,
        bool $maintainFilename = false
    ): static {
        $self = new self();

        $self->imageFolder = $imageDirectory;
        $self->imageFields = $imageFields;
        $self->storageDisk = $storageDisk ?? config('has-image-laravel.default', 'local');
        $self->maintainFilename = $maintainFilename;

        return $self;
    }

    public function basePath(): string
    {
        return rtrim($this->imageFolder, DIRECTORY_SEPARATOR);
    }

    public function generateFullPath(UploadedFile $file): string
    {
        return ($this->maintainFilename)
            ? $this->basePath() . DIRECTORY_SEPARATOR . $file->getClientOriginalName()
            : $file->hashName($this->basePath());
    }
}
