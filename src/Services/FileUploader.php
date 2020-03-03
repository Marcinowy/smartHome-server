<?php

namespace App\Services;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $container, $filename, $error = null;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function UploadFile (UploadedFile $file)
    {
        $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

        try {
            $file->move(
                $this->container->getParameter('uploadsDir'),
                $filename
            );
            $this->filename = $filename;
        } catch (FileException $e) {
            $this->error = $e;
        }
    }
    public function getError()
    {
        return $this->error;
    }
    public function hasError()
    {
        return ($this->error != null);
    }
    public function getFileName()
    {
        return $this->filename;
    }
}