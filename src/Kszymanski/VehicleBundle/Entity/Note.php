<?php

namespace Kszymanski\VehicleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Note
{
    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var integer
     *
     * @Assert\Choice(choices = {1, 2, 3}, message = "Wybierz priorytet z listy")
     * @ORM\Column(name="priority", type="smallint")
     */
    private $priority;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Model", inversedBy="notes")
     * @ORM\JoinTable()
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
     * Set title
     *
     * @param string $title
     * @return Note
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Note
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Note
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Add models
     *
     * @param \Kszymanski\VehicleBundle\Entity\Model $models
     * @return Note
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
