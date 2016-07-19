<?php

namespace Code\CarBundle\Service;

use Code\CarBundle\Entity\ManufacturerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ManufacturerService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ManufacturerService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function insert(ManufacturerInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update(ManufacturerInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function delete(ManufacturerInterface $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}
