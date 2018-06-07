<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/6/2018
 * Time: 1:02 PM
 */

namespace OC\BrokersBundle\Repository;
use OC\BrokersBundle\Entity\BrokerPays;
use OC\BrokersBundle\Entity\GlobalParent;
use Doctrine\ORM\EntityRepository;

class BrokerPaysRepository extends EntityRepository
{
    public function findAllInheritance()
    {

  $dql =   'SELECT p.link, (CASE WHEN T.link IS NULL
    THEN (SELECT A.link FROM BrokersBundle:GlobalParent A WHERE A.name = p.parent)
    ELSE p.link
    END) from BrokersBundle:BrokerPays p';




// build subquery
        $subquery = $this->createQueryBuilder('broker')
            ->select('parent.link')
            ->where('parent.name = broker.parent')
            ->from('OC\BrokersBundle\Entity\GobalParent','parent');
        ;
        $em = $this->getEntityManager();
        $query3 = $em->createQuery('SELECT A.link FROM BrokersBundle:GlobalParent  A  WHERE A.name = broker.parent');
//        var_dump($query3->getResult());

        $qb =  $this->createQueryBuilder('broker')
            ->select('broker.id,broker.name, 
            CASE WHEN broker.link IS NULL
    THEN  broker.review
    ELSE broker.link
    END link,
    CASE WHEN broker.logo IS NULL
    THEN broker.review
    ELSE broker.logo
    END logo,
    CASE WHEN broker.crypto IS NULL
    THEN broker.review
    ELSE broker.crypto
    END crypto,
    CASE WHEN broker.review IS NULL
    THEN broker.review
    ELSE broker.review
    END review,
    CASE WHEN broker.score IS NULL
    THEN broker.review
    ELSE broker.score
    END score,
    CASE WHEN broker.displayName IS NULL
    THEN broker.review
    ELSE broker.displayName
    END displayName
    ');


        $query2 = $em->createQuery(
            'SELECT broker.id,broker.name, 
            CASE WHEN broker.link IS NULL
    THEN ('.$query3->getResult().')
    ELSE broker.link
    END link,
    CASE WHEN broker.logo IS NULL
    THEN broker.review
    ELSE broker.logo
    END logo,
    CASE WHEN broker.crypto IS NULL
    THEN broker.review
    ELSE broker.crypto
    END crypto,
    CASE WHEN broker.review IS NULL
    THEN broker.review
    ELSE broker.review
    END review,
    CASE WHEN broker.score IS NULL
    THEN broker.review
    ELSE broker.score
    END score,
    CASE WHEN broker.displayName IS NULL
    THEN broker.review
    ELSE broker.displayName
    END displayName
    FROM BrokersBundle:BrokerPays broker '
        )->setParameters(array('broker'=> broker));

        $products = $query2->getResult();
        var_dump($products);

        $query = $qb->getQuery();

        //return $query->execute();
        return $products;
}


}