<?php

namespace AppBundle\Repository;

/**
 * PanRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PanRepository extends \Doctrine\ORM\EntityRepository
{

    public function getPan()
    {
        $query="
        SELECT p
        FROM AppBundle:Pan p
        WHERE p.etat =0";

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}