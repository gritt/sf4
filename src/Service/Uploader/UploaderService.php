<?php

namespace App\Service\Uploader;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class UploaderService
 * @package App\Service\Uploader
 */
class UploaderService
{
    /**
     * @var ParameterBag
     */
    private $parameterBag;


    /**
     * UploaderService constructor.
     * @param ParameterBag $parameterBag
     */
    public function __construct(ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @param File $file
     * @return null|File
     */
    public function upload(File $file): ?File
    {
        $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

        try {
            $file->move(
                $this->parameterBag->get('products_directory'),
                $fileName
            );
        } catch (FileException $e) {
            //TODO @gritt, handle it
        }

        return new File($fileName);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(): string
    {
        return md5(uniqid());
    }
}