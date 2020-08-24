<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poids
 *
 * @ORM\Table(name="poids")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PoidsRepository")
 */
class Poids
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
     * @var int
     *
     * @ORM\Column(name="min", type="integer")
     */
    private $min;

    /**
     * @var int
     *
     * @ORM\Column(name="max", type="integer")
     */
    private $max;

    /**
     * @var string
     *
     * @ORM\Column(name="Prix", type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="espace", type="string", length=255)
     */
    private $espace;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Kilo",mappedBy="poid",cascade={"remove"})
     */

    private $kilos;

    /**
     * @return mixed
     */
    public function getKilos()
    {
        return $this->kilos;
    }

    /**
     * @param mixed $kilos
     */
    public function setKilos($kilos)
    {
        $this->kilos = $kilos;
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
     * Set min
     *
     * @param integer $min
     *
     * @return Poids
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param integer $max
     *
     * @return Poids
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Poids
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set espace
     *
     * @param string $espace
     *
     * @return Poids
     */
    public function setEspace($espace)
    {
        $this->espace = $espace;

        return $this;
    }

    /**
     * Get espace
     *
     * @return string
     */
    public function getEspace()
    {
        return $this->espace;
    }
}

