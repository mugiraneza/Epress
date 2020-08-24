<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soin
 *
 * @ORM\Table(name="soin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoinRepository")
 */
class Soin
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prix", type="decimal", precision=10, scale=2)
     */
    private $prix;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pan",mappedBy="soin",cascade={"remove"})
     */

    private $pans;

    /**
     * @return mixed
     */
    public function getPans()
    {
        return $this->pans;
    }

    /**
     * @param mixed $pans
     */
    public function setPans($pans)
    {
        $this->pans = $pans;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Soin
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Soin
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
}

