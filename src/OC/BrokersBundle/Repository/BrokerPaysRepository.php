<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/6/2018
 * Time: 1:02 PM
 */

namespace OC\BrokersBundle\Repository;
use Doctrine\ORM\Query;
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
            ->from('OC\BrokersBundle\Entity\GobalParent','parent')
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

//        'SELECT broker.id,broker.name,
//            CASE WHEN broker.link IS NULL
//    THEN (SELECT A.link FROM BrokersBundle:GlobalParent  A  WHERE A.name = broker.parent)
//    ELSE broker.link
//    END link,
//    CASE WHEN broker.logo IS NULL
//    THEN broker.review
//    ELSE broker.logo
//    END logo,
//    CASE WHEN broker.crypto IS NULL
//    THEN broker.review
//    ELSE broker.crypto
//    END crypto,
//    CASE WHEN broker.review IS NULL
//    THEN broker.review
//    ELSE broker.review
//    END review,
//    CASE WHEN broker.score IS NULL
//    THEN broker.review
//    ELSE broker.score
//    END score,
//    CASE WHEN broker.displayName IS NULL
//    THEN broker.review
//    ELSE broker.displayName
//    END displayName
//    FROM BrokersBundle:BrokerPays broker ');
        $query2 = $em->createQuery(
            'SELECT broker.id,broker.name, 
            CASE WHEN broker.link IS NULL
    THEN (SELECT broker.id FROM BrokersBundle:GlobalParent  A  WHERE A.name = broker.parent)
    ELSE broker.link
    END link
    FROM BrokersBundle:BrokerPays broker
     ');
//        )->setParameters(array('broker'=> broker))


        $products = $query2->getResult();
        var_dump($products);

        $query = $qb->getQuery();

        //return $query->execute();
        return $products;
}










    public function subquery()
    {
//        $subQuery = (new Query())->select('name')->from('OC\BrokersBundle\Entity\BrokerPays');
//
//// SELECT `id`, (SELECT COUNT(*) FROM `user`) AS `count` FROM `post`
//        $query = (new Query())->select(['name', 'link' => $subQuery])->from('OC\BrokersBundle\Entity\BrokerPays');
//

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb3 = $em->createQueryBuilder();
        $subQuery = $qb2
            ->select("broker.name")
          ->where("broker.id=1")
            ->from("BrokersBundle:BrokerPays", "broker")
            ->getDQL()
           ;


        $q = $qb
            ->select("broker.name");

        $su2 = $qb3
            ->select("broker.name")
            ->where("broker.id=1")
            ->from("BrokersBundle:BrokerPays", "broker")

        ;

        $name = ($su2->getQuery()->getResult()[0])["name"];
//       dump( $su2
//           ->getQuery()
//           ->getResult());


    $qb
            ->addSelect("CASE WHEN (broker.link IS NULL) THEN  ('.$name.') ELSE broker.link END link")
            ->from("BrokersBundle:BrokerPays", "broker");

        dump( ($su2->getQuery()->getResult()[0])["name"]);



        return  $q ->getQuery()
        ->execute();
//
//
//        $products = $qb->
//        var_dump($products);
//
//
//
//        return $products;
    }



    public function subquerybuilder()
    {
        $em = $this->getEntityManager();

        $query2 = $em->createQuery(
            'SELECT broker.id, broker.name, 
 COALESCE(broker.link, parent.link)
AS link,
COALESCE(broker.logo, parent.logo)
AS logo,
COALESCE(broker.crypto, parent.crypto)
AS crypto,
COALESCE(broker.review, parent.review)
AS review,
COALESCE(broker.score, parent.score)
AS score,
COALESCE(broker.displayName, parent.displayName)
AS displayName
 FROM BrokersBundle:BrokerPays broker 
 JOIN BrokersBundle:GlobalParent parent 
 WITH parent.name = broker.parent

');
//        )->setParameters(array('broker'=> broker))


        $products = $query2->getResult();
        dump($products);



        //return $query->execute();
        return $products;
//

    }
    public function ifif()
    {
        $em = $this->getEntityManager();

        $query2 = $em->createQuery(
            'SELECT coin.name, COALESCE(coin.logo, parent.logo) as new FROM BrokersBundle:BrokerPays coin
 JOIN BrokersBundle:GlobalParent parent WITH parent.name = coin.parent
 
');
//        )->setParameters(array('broker'=> broker))


        $products = $query2->getResult();
        dump($products);



        //return $query->execute();
        return $products;
//

    }

}