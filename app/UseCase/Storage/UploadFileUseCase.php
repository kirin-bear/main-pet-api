<?php

declare(strict_types=1);

namespace App\UseCase\Storage;

use App\Models\KirinBear\User;
use App\UseCase\Storage\Dto\FileDto;
use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Filesystem\FilesystemManager;
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
     *
     * @throws Exception
     */
    public function execute(User $user, UploadedFile ...$uploadedFiles): array
    {
        $disk = $this->filesystemManager->disk('minio');
        $files = [];

        if (!$disk instanceof AwsS3V3Adapter) {
            throw new Exception("Неизвестный адаптер для работы с файлами");
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
