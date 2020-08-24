<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Linge
 *
 * @ORM\Table(name="linge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LingeRepository")
 */
class Linge
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
     * @ORM\Column(name="Libelle", type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Depot",mappedBy="linge",cascade={"remove"})
     */

    private $depots;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Linge
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->depots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add depot
     *
     * @param \AppBundle\Entity\Depot $depot
     *
     * @return Linge
     */
    public function addDepot(\AppBundle\Entity\Depot $depot)
    {
        $this->depots[] = $depot;

        return $this;
    }

    /**
     * Remove depot
     *
     * @param \AppBundle\Entity\Depot $depot
     */
    public function removeDepot(\AppBundle\Entity\Depot $depot)
    {
        $this->depots->removeElement($depot);
    }

    /**
     * Get depots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepots()
    {
        return $this->depots;
    }
}
