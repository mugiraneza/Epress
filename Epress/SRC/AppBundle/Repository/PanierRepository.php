<?php

namespace AppBundle\Repository;

/**
 * PanierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PanierRepository extends \Doctrine\ORM\EntityRepository
{

    public function getPanier()
    {
        $query="
        SELECT p
        FROM AppBundle:Panier p
        WHERE p.etat =0";

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}
