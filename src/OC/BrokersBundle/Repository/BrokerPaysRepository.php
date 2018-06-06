<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/6/2018
 * Time: 1:02 PM
 */

namespace OC\BrokersBundle\Repository;
use OC\BrokersBundle\Entity\BrokerPays;
use Doctrine\ORM\EntityRepository;

class BrokerPaysRepository extends EntityRepository
{
    public function findAllInheritance()
    {

  $dql =   'SELECT p.link, (CASE WHEN T.link IS NULL
    THEN (SELECT A.link FROM BrokersBundle:GlobalParent A WHERE A.name = p.parent)
    ELSE p.link
    END) from BrokersBundle:BrokerPays p';



        $qb =  $this->createQueryBuilder('broker')

            ->select(' CASE WHEN broker.link IS NULL
    THEN broker.review
    ELSE broker.link
    END');
        ;
     $query = $qb->getQuery();
     var_dump($query->getDQL());
        return $query->execute();
}


}