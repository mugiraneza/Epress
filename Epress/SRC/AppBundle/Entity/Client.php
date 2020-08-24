<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="Nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=60)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="NomPrenom", type="string", length=110)
     */
    private $nomPrenom;

    /**
     * @return string
     */
    public function getNomPrenom()
    {
        return $this->nomPrenom;
    }

    /**
     * @param string $nomPrenom
     */
    public function setNomPrenom($nomPrenom)
    {
        $this->nomPrenom = $nomPrenom;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=40)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Depot",mappedBy="client",cascade={"remove"})
     */

    private $depots;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Paiement",mappedBy="client",cascade={"remove"})
     */

    private $paiements;


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
     * @return Client
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Client
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Client
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->depots = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setNomPrenom($this->getNom().' '.$this->getPrenom());
    }

    /**
     * Add depot
     *
     * @param \AppBundle\Entity\Depot $depot
     *
     * @return Client
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

    /**
     * Add paiement
     *
     * @param \AppBundle\Entity\Paiement $paiement
     *
     * @return Client
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
}
