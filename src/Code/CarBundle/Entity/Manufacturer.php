<?php

namespace Code\CarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="code_manufacturers")
 * @ORM\Entity(repositoryClass="Code\CarBundle\Entity\ManufacturerRepository")
 */
class Manufacturer implements ManufacturerInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Car", mappedBy="manufacturer", cascade={"persist", "remove"})
     */
    private $cars;

    /**
     * Manufacturer constructor.
     */
    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Manufacturer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param mixed $car
     * @return Manufacturer
     */
    public function addCar($car)
    {
        $this->cars[] = $car;
        return $this;
    }
}
