<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaiementRepository")
 */
class Paiement
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
     * @ORM\Column(name="Montant", type="decimal", precision=10, scale=2)
     */
    private $montant;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;

    /**
 *
 * @var Client $client
 *
 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client",inversedBy="paiements")
 *
 * @ORM\JoinColumn(nullable=false)
 */

    private $client;

    /**
     *
     * @var Depot $depot
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Depot",inversedBy="paiements")
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $depot;


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
     * Set montant
     *
     * @param string $montant
     *
     * @return Paiement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Paiement
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Paiement
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
     * Set depot
     *
     * @param \AppBundle\Entity\Depot $depot
     *
     * @return Paiement
     */
    public function setDepot(\AppBundle\Entity\Depot $depot)
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * Get depot
     *
     * @return \AppBundle\Entity\Depot
     */
    public function getDepot()
    {
        return $this->depot;
    }

}
