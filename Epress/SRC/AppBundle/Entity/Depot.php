<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Depot
 *
 * @ORM\Table(name="depot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepotRepository")
 */
class Depot
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
     * @ORM\Column(name="DateDepot", type="date")
     */
    private $dateDepot;


    /**
     * @var string
     *
     * @ORM\Column(name="Prix", type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="avance", type="decimal", precision=10, scale=2)
     */
    private $avance;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="decimal", precision=10, scale=2)
     */
    private $remise;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer")
     *
     *
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=30)
     */
    private $statut;




    /**
     *
     * @var Client $client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client",inversedBy="depots")
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $client;

    /**
     *
     * @var Linge $linge
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Linge",inversedBy="depots")
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $linge;



    /**
     *
     * @var Couleur $couleur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Couleur",inversedBy="depots")
     *
     * @ORM\JoinColumn(nullable=false)
     */


    private $couleur;

    /**
     *
     * @var TypeTissu $tissu
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeTissu",inversedBy="depots")
     *
     * @ORM\JoinColumn(nullable=false)
     */


    private $tissu;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Paiement",mappedBy="depot",cascade={"remove"})
     */

    private $paiements;
    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
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
     * Set dateDepot
     *
     * @param \DateTime $dateDepot
     *
     * @return Depot
     */
    public function setDateDepot($dateDepot)
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    /**
     * Get dateDepot
     *
     * @return \DateTime
     */
    public function getDateDepot()
    {
        return $this->dateDepot;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Depot
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
     * Set statut
     *
     * @param string $statut
     *
     * @return Depot
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Depot
     */
    public function setClient(\AppBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set linge
     *
     * @param \AppBundle\Entity\Linge $linge
     *
     * @return Depot
     */
    public function setLinge(\AppBundle\Entity\Linge $linge)
    {
        $this->linge = $linge;

        return $this;
    }

    /**
     * Get linge
     *
     * @return \AppBundle\Entity\Linge
     */
    public function getLinge()
    {
        return $this->linge;
    }

    /**
     * Set couleur
     *
     * @param \AppBundle\Entity\Couleur $couleur
     *
     * @return Depot
     */
    public function setCouleur(\AppBundle\Entity\Couleur $couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return \AppBundle\Entity\Couleur
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set tissu
     *
     * @param \AppBundle\Entity\TypeTissu $tissu
     *
     * @return Depot
     */
    public function setTissu(\AppBundle\Entity\TypeTissu $tissu)
    {
        $this->tissu = $tissu;

        return $this;
    }

    /**
     * Get tissu
     *
     * @return \AppBundle\Entity\TypeTissu
     */
    public function getTissu()
    {
        return $this->tissu;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paiements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add paiement
     *
     * @param \AppBundle\Entity\Paiement $paiement
     *
     * @return Depot
     */
    public function addPaiement(\AppBundle\Entity\Paiement $paiement)
    {
        $this->paiements[] = $paiement;

        return $this;
    }

    /**
     * Remove paiement
     *
     * @param \AppBundle\Entity\Paiement $paiement
     */
    public function removePaiement(\AppBundle\Entity\Paiement $paiement)
    {
        $this->paiements->removeElement($paiement);
    }

    /**
     * Get paiements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaiements()
    {
        return $this->paiements;
    }

    /**
     * Set avance
     *
     * @param string $avance
     *
     * @return Depot
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;

        return $this;
    }

    /**
     * Get avance
     *
     * @return string
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * Set remise
     *
     * @param string $remise
     *
     * @return Depot
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string
     */
    public function getRemise()
    {
        return $this->remise;
    }
}
