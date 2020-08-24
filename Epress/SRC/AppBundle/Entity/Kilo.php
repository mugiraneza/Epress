<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kilo
 *
 * @ORM\Table(name="kilo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KiloRepository")
 */
class Kilo
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
     * @ORM\Column(name="Date", type="date")
     */
    private $date;

    /**
     *
     * @var Poids $poid
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Poids",inversedBy="kilos")
     *
     * @ORM\JoinColumn(nullable=false)
     */


    private $poid;

    /**
     * @return Poids
     */
    public function getPoid()
    {
        return $this->poid;
    }

    /**
     * @param Poids $poid
     */
    public function setPoid($poid)
    {
        $this->poid = $poid;
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
     * @return Kilo
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
}

