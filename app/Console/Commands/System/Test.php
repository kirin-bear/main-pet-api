<?php

declare(strict_types=1);

namespace App\Console\Commands\System;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Likelihood;
use Illuminate\Console\Command;

class Test extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:google-cloud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Тестирование google cloud vision api';


    public function handle(): void
    {
        $client = new ImageAnnotatorClient();

        // Annotate an image, detecting faces.
        $annotation = $client->annotateImage(
            fopen('/data/photos/family_photo.jpg', 'r'),
            [Type::FACE_DETECTION, Type::LABEL_DETECTION]
        );

        // Determine if the detected faces have headwear.
        foreach ($annotation->getFaceAnnotations() as $faceAnnotation) {
            $likelihood = Likelihood::name($faceAnnotation->getHeadwearLikelihood());
            echo "Likelihood of headwear: $likelihood" . PHP_EOL;
        }

        dd('stop');
    }
}