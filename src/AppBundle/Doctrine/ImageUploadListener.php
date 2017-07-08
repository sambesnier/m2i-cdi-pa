<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 08/07/2017
 * Time: 14:15
 */

namespace AppBundle\Doctrine;


use AppBundle\Entity\Image;
use AppBundle\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function uploadFile($entity)
    {
        if (!$entity instanceof Image) {
            return;
        }

        $file = $entity->getFile();

        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setFile($fileName);
        $entity->setUrl("images/uploads/photos/".$fileName);
        $entity->setAlt("Photo habitation");
    }
}