<?php

declare(strict_types=1);

namespace App\Domains\Storage\UseCases;

use App\Domains\Storage\Dto\FileDto;
use App\Models\KirinBear\User;
use Exception;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Filesystem\FilesystemManager;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileUseCase
{
    private FilesystemManager $filesystemManager;

    public function __construct(FilesystemManager $filesystemManager)
    {
        $this->filesystemManager = $filesystemManager;
    }

    /**
     * @param UploadedFile ...$uploadedFiles
     *
     * @return FileDto[]
     *
     * @throws Exception
     */
    public function execute(User $user, UploadedFile ...$uploadedFiles): array
    {
        $disk = $this->filesystemManager->disk('minio');
        $files = [];

        if (!$disk instanceof AwsS3V3Adapter) {
            throw new RuntimeException("Неизвестный адаптер для работы с файлами");
        }

        foreach ($uploadedFiles as $uploadedFile) {

            $file = new FileDto($uploadedFile->getClientOriginalName());

            $name = '/memories/'.$user->id.'/'.date('Y-m-d').'/'.$file->getName();

            $isSaved = $disk->put($name, $uploadedFile->getContent(), ['visibility' => 'public']);

            if ($isSaved) {
                $file->setUrl($disk->url($name));
            }

            $files[] = $file;
        }

        return $files;
    }

}
