<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 08/07/2017
 * Time: 14:25
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    /**
     * FileUploader constructor.
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = uniqid("photo_").".".$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

}