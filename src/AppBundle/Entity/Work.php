<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Acounter" , mappedBy="type")
     *
     *
     */
    private $acounters;

    /**
     * Work constructor.
     * @param ArrayCollection $acounters
     */
    public function __construct()
    {
        $this->acounters = new ArrayCollection();
    }



    /**
     *
     */
    public function getAcounters()
    {

        return $this->acounters;

    }

    /**
     * @var Acounter
     */
    public function setAcounters(Acounter $acounters)
    {
        $this->acounters[] = $acounters;
        return $this;
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

