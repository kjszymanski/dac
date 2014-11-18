<?php

namespace Kszymanski\VehicleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Model
 *
 * @ORM\Table("models")
 * @ORM\Entity()
 */
class Model
{
    public function __construct()
    {
        $this->notes = new ArrayCollection();
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
     * @ORM\Column(name="model_name", type="string", length=100)
     */
    private $name;

    /**
     * @var Make
     *
     * @ORM\ManyToOne(targetEntity="Make", inversedBy="models")
     * @ORM\JoinColumn(name="make_id", referencedColumnName="id")
     */
    private $make;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Note", mappedBy="models")
     */
    private $notes;


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
     * @return Model
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
     * @return Model
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set make
     *
     * @param Make $make
     * @return Model
     */
    public function setMake(Make $make = null)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return Make
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Add notes
     *
     * @param \Kszymanski\VehicleBundle\Entity\Note $notes
     * @return Model
     */
    public function addNote(\Kszymanski\VehicleBundle\Entity\Note $notes)
    {
        $this->notes[] = $notes;

        return $this;
    }

    /**
     * Remove notes
     *
     * @param \Kszymanski\VehicleBundle\Entity\Note $notes
     */
    public function removeNote(\Kszymanski\VehicleBundle\Entity\Note $notes)
    {
        $this->notes->removeElement($notes);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotes()
    {
        return $this->notes;
    }
}
