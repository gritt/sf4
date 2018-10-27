<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Uploader
 * @package App\Service
 */
class Uploader
{
    /**
     * @var ParameterBagInterface
     */
    private $params;


    /**
     * Uploader constructor.
     * @param ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @param File $file
     * @return null|File
     */
    public function upload(File $file): ?File
    {
        try {

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            $file->move(
                $this->params->get('products_directory'),
                $fileName
            );

            return new File($fileName);

        } catch (FileException $e) {
            //TODO @gritt, handle it
        }

        return $file;
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(): string
    {
        return md5(uniqid());
    }
}