<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pan
 *
 * @ORM\Table(name="pan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PanRepository")
 */
class Pan
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;


    /**
     *
     * @var Soin $soin
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Soin",inversedBy="pan")
     *
     * @ORM\JoinColumn(nullable=false)
     */


    private $soin;

    /**
     * @return Soin
     */
    public function getSoin()
    {
        return $this->soin;
    }

    /**
     * @param Soin $soin
     */
    public function setSoin($soin)
    {
        $this->soin = $soin;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Pan
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Pan
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }
}

