<?php

namespace Kszymanski\VehicleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Make
 *
 * @ORM\Table("makes")
 * @ORM\Entity
 */
class Make
{
    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="make_name", type="string", length=100)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Model", mappedBy="make")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $models;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Make
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Make
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add models
     *
     * @param \Kszymanski\VehicleBundle\Entity\Model $models
     * @return Make
     */
    public function addModel(\Kszymanski\VehicleBundle\Entity\Model $models)
    {
        $this->models[] = $models;

        return $this;
    }

    /**
     * Remove models
     *
     * @param \Kszymanski\VehicleBundle\Entity\Model $models
     */
    public function removeModel(\Kszymanski\VehicleBundle\Entity\Model $models)
    {
        $this->models->removeElement($models);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModels()
    {
        return $this->models;
    }
}
