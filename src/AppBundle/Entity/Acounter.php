<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Acounter
 *
 * @ORM\Table(name="acounters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AcounterRepository")
 */
class Acounter
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
     *
     * @var Work
     * @ORM\ManyToOne ( targetEntity="AppBundle\Entity\Work" , inversedBy="acounters" )
     *
     */
    private $type;

    private $typeWork;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="objectName", type="string", length=255, nullable=true)
     */
    private $objectName;

    /**
     * @var string
     *
     * @ORM\Column(name="notice", type="string", length=255, nullable=true)
     */
    private $notice;

    /**
     * @var string
     *
     * @ORM\Column(name="moneyRecived", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $moneyRecived;

    /**
     * @var string
     *
     * @ORM\Column(name="moneyPayed", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $moneyPayed;
   /**
     * @var string
     *
     * @ORM\Column(name="itemBuyed_1", type="string", length=255, nullable=false)
     */
    private $itemBuyed1;

    /**
     * @var string
     *
     * @ORM\Column(name="itemBuyed_2", type="string", length=255, nullable=false)
     */
    private $itemBuyed2;

    /**
     * @var string
     *
     * @ORM\Column(name="itemBuyed_3", type="string", length=255, nullable=false)
     */
    private $itemBuyed3;

    /**
     * @var string
     *
     * @ORM\Column(name="itemBuyed_4", type="string", length=255, nullable=false)
     */
    private $itemBuyed4;

    /**
     * @var string
     *
     * @ORM\Column(name="itemBuyed_5", type="string", length=255, nullable=false)
     */
    private $itemBuyed5;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateWork", type="datetime")
     */
    private $dateWork;


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
     * Set objectName
     *
     * @param string $objectName
     *
     * @return Acounter
     */
    public function setObjectName($objectName)
    {
        $this->objectName = $objectName;

        return $this;
    }

    /**
     * Get objectName
     *
     * @return string
     */
    public function getObjectName()
    {
        return $this->objectName;
    }

    /**
     * Set notice
     *
     * @param string $notice
     *
     * @return Acounter
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;

        return $this;
    }

    /**
     * Get notice
     *
     * @return string
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * Set moneyRecived
     *
     * @param string $moneyRecived
     *
     * @return Acounter
     */
    public function setMoneyRecived($moneyRecived)
    {
        $this->moneyRecived = $moneyRecived;

        return $this;
    }

    /**
     * Get moneyRecived
     *
     * @return string
     */
    public function getMoneyRecived()
    {
        return $this->moneyRecived;
    }

    /**
     * Set moneyPayed
     *
     * @param string $moneyPayed
     *
     * @return Acounter
     */
    public function setMoneyPayed($moneyPayed)
    {
        $this->moneyPayed = $moneyPayed;

        return $this;
    }

    /**
     * Get moneyPayed
     *
     * @return string
     */
    public function getMoneyPayed()
    {
        return $this->moneyPayed;
    }

    /**
     * Set itemBuyed1
     *
     * @param string $itemBuyed1
     *
     * @return Acounter
     */
    public function setItemBuyed1($itemBuyed1)
    {
        $this->itemBuyed1 = $itemBuyed1;

        return $this;
    }

    /**
     * Get itemBuyed1
     *
     * @return string
     */
    public function getItemBuyed1()
    {
        return $this->itemBuyed1;
    }

    /**
     * Set itemBuyed2
     *
     * @param string $itemBuyed2
     *
     * @return Acounter
     */
    public function setItemBuyed2($itemBuyed2)
    {
        $this->itemBuyed2 = $itemBuyed2;

        return $this;
    }

    /**
     * Get itemBuyed2
     *
     * @return string
     */
    public function getItemBuyed2()
    {
        return $this->itemBuyed2;
    }

    /**
     * Set itemBuyed3
     *
     * @param string $itemBuyed3
     *
     * @return Acounter
     */
    public function setItemBuyed3($itemBuyed3)
    {
        $this->itemBuyed3 = $itemBuyed3;

        return $this;
    }

    /**
     * Get itemBuyed3
     *
     * @return string
     */
    public function getItemBuyed3()
    {
        return $this->itemBuyed3;
    }

    /**
     * Set itemBuyed4
     *
     * @param string $itemBuyed4
     *
     * @return Acounter
     */
    public function setItemBuyed4($itemBuyed4)
    {
        $this->itemBuyed4 = $itemBuyed4;

        return $this;
    }

    /**
     * Get itemBuyed4
     *
     * @return string
     */
    public function getItemBuyed4()
    {
        return $this->itemBuyed4;
    }

    /**
     * Set itemBuyed5
     *
     * @param string $itemBuyed5
     *
     * @return Acounter
     */
    public function setItemBuyed5($itemBuyed5)
    {
        $this->itemBuyed5 = $itemBuyed5;

        return $this;
    }

    /**
     * Get itemBuyed5
     *
     * @return string
     */
    public function getItemBuyed5()
    {
        return $this->itemBuyed5;
    }

    /**
     * Set dateWork
     *
     * @param \DateTime $dateWork
     *
     * @return Acounter
     */
    public function setDateWork($dateWork)
    {
        $this->dateWork = $dateWork;

        return $this;
    }

    /**
     * Get dateWork
     *
     * @return \DateTime
     */
    public function getDateWork()
    {
        return $this->dateWork;
    }

    /**
     * @return mixed
     */
    public function getTypeWork()
    {
        return $this->typeWork;
    }

    /**
     * @param mixed $typeWork
     */
    public function setTypeWork($typeWork)
    {
        $this->typeWork = $typeWork;
    }

}

