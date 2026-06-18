<?php

declare(strict_types=1);

namespace RPWebDevelopment\HasImageLaravel\Traits;

use enshrined\svgSanitize\Sanitizer;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RPWebDevelopment\HasImageLaravel\Dto\ImageDetails;

trait HasImage
{
    protected ?ImageDetails $imageDetails = null;

    abstract public function getImageDetails(): ImageDetails;

    protected static function bootHasImage(): void
    {
        static::creating(function (self $model) {
            $model->storeImage();
        });

        static::updating(function (self $model) {
            $model->storeImage();
        });
    }

    private function setImageDetails(): void
    {
        $this->imageDetails = $this->imageDetails ?? $this->getImageDetails();
    }

    protected function storeImage(): void
    {
        $this->setImageDetails();
        $fields = $this->imageDetails?->imageFields ?? [];

        foreach ($fields as $imageField) {
            $file = $this->getImageFieldValue($imageField);
            if (!$file instanceof UploadedFile) {
                continue;
            }

            $filepath = $this->imageDetails->generateFullPath($file);
            $fileContent = $this->sanitizeImage($file);
            Storage::disk($this->imageDetails->storageDisk)
                ->put($filepath, $fileContent);

            $this->setImageFieldValue($imageField, $filepath);
        }
    }

    protected function getStorageDisk(): Filesystem
    {
        $this->setImageDetails();

        return Storage::disk($this->imageDetails->storageDisk);
    }

    protected function getImage(string $filepath): ?string
    {
        return $this->getStorageDisk()->path($filepath);
    }

    protected function getImageFile(string $filepath): ?string
    {
        return $this->getStorageDisk()->get($filepath);
    }

    protected function getImageFieldValue(?string $field): null|string|UploadedFile
    {
        return (!$field) ? null : $this->{$field};
    }

    protected function setImageFieldValue(string $field, string $value): void
    {
        $this->{$field} = $value;
    }

    private function sanitizeImage(UploadedFile $file): string
    {
        if (!$this->isSvg($file)) {
            return $file->getContent();
        }

        return (new Sanitizer())->sanitize($file->getContent());
    }

    private function isSvg(UploadedFile $file): bool
    {
        return (
            $file->getClientOriginalExtension() === 'svg'
            || $file->getMimeType() === 'image/svg+xml'
        );
    }
}
