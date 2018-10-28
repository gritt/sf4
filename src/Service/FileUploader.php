<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     */
    private $targetDirectory;


    /**
     * FileUploader constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->targetDirectory = $parameterBag->get('products_directory');
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        try {

            $file->move(
                $this->getTargetDirectory(),
                $fileName
            );

        } catch (FileException $e) {
            dump($e->getMessage());
            die;
        }

        return $fileName;
    }

    /**
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }


    /**
     * @param string $path
     * @return null|File
     */
    public function getFile(string $path): ?File
    {
        try {
            return new File($this->targetDirectory . DIRECTORY_SEPARATOR . $path);
        } catch (FileException $e) {
            return null;
        }
    }
}