<?php

namespace AppBundle\Repository;

/**
 * Statistique3Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Statistique3Repository extends \Doctrine\ORM\EntityRepository
{
    public function getS($debut,$fin)
    {
        $query="
        SELECT s
        FROM AppBundle:Statistique3 s
        WHERE s.date BETWEEN '$debut' and '$fin'";

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}