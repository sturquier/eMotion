<?php

namespace LocationBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LocationBundle\Entity\Vehicle;
use LocationBundle\Service\PictureUploader;

class PictureUploadListener
{
    private $uploader;

    public function __construct(PictureUploader $uploader)
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

    private function uploadFile($entity)
    {
        // upload only works for Vehicle entities
        if (!$entity instanceof Vehicle) {
            return;
        }

        $picture = $entity->getPicture();

        // only upload new files
        if (!$picture instanceof UploadedFile) {
            return;
        }

        $pictureName = $this->uploader->upload($picture);
        $entity->setPicture($pictureName);
    }
}