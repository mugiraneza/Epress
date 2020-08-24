<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeTissu
 *
 * @ORM\Table(name="type_tissu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeTissuRepository")
 */
class TypeTissu
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Depot",mappedBy="tissu",cascade={"remove"})
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
     * @return TypeTissu
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
     * @return TypeTissu
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
