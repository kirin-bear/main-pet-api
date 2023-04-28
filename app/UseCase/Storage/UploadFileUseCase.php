<?php

declare(strict_types=1);

namespace App\UseCase\Storage;

use App\UseCase\Storage\Dto\FileDto;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileUseCase
{
    private FilesystemManager $filesystemManager;
    private Filesystem $filesystem;

    public function __construct(FilesystemManager $filesystemManager, Filesystem $filesystem)
    {
        $this->filesystemManager = $filesystemManager;
        $this->filesystem = $filesystem;
    }

    /**
     * @param UploadedFile ...$uploadedFiles
     *
     * @return FileDto[]
     */
    public function execute(UploadedFile ...$uploadedFiles): array
    {
        $disk = $this->filesystemManager->disk('minio');
        $files = [];

        foreach ($uploadedFiles as $uploadedFile) {

            $file = new FileDto($uploadedFile->getClientOriginalName());

            $name = '/'.date('Y-m-d').'/'.$file->getName();

            $isSaved = $disk->put($name, $uploadedFile->getContent(), ['visibility' => 'public']);

            if ($isSaved) {
                $file->setUrl($this->filesystemManager->url($name));
            }

            $files[] = $file;
        }

        return $files;
    }

}
