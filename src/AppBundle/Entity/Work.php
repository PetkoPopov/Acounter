<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Work
 *
 * @ORM\Table(name="works")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkRepository")
 */
class Work
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typeWork", type="string", length=255, nullable=true)
     */
    private $typeWork;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Acounter" , mappedBy="type")
     *
     *
     */
    private $acounters;


    /**
     * @return ArrayCollection
     */
    public function getAcounters(): ArrayCollection
    {
        return $this->acounters;
    }

    /**
     * @param ArrayCollection $acounters
     */
    public function setAcounters(ArrayCollection $acounters)
    {
        $this->acounters = $acounters;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeWork
     *
     * @param string $typeWork
     *
     * @return Work
     */
    public function setTypeWork($typeWork)
    {
        $this->typeWork = $typeWork;

        return $this;
    }

    /**
     * Get typeWork
     *
     * @return string
     */
    public function getTypeWork()
    {
        return $this->typeWork;
    }
}

