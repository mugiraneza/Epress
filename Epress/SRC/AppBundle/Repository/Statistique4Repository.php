<?php

namespace AppBundle\Repository;

/**
 * Statistique4Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Statistique4Repository extends \Doctrine\ORM\EntityRepository
{
    public function getSituation($debut,$fin)
    {
        $query="
        SELECT s
        FROM AppBundle:Statistique4 s
        WHERE s.date BETWEEN '$debut' and '$fin'";

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}
