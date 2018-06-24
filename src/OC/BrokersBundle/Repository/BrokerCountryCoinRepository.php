<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/6/2018
 * Time: 1:02 PM
 */

namespace OC\BrokersBundle\Repository;
use OC\BrokersBundle\Entity\BrokerCountryCoin;
use Doctrine\ORM\EntityRepository;

class BrokerCountryCoinRepository extends EntityRepository
{
    public function test()
    {
        $em = $this->getEntityManager();

        $query2 = $em->createQuery(
            'SELECT coin.id, coin.name, 
 COALESCE(coin.link,broker.link, parent.link)
AS link,
COALESCE(coin.logo,broker.logo, parent.logo)
AS logo,
COALESCE(coin.crypto, broker.crypto, parent.crypto)
AS crypto,
COALESCE(coin.review,broker.review, parent.review)
AS review,
COALESCE(coin.score,broker.score, parent.score)
AS score,
COALESCE(coin.displayName, broker.displayName, parent.displayName)
AS displayName
 FROM BrokersBundle:BrokerCountryCoin coin 
  JOIN BrokersBundle:BrokerPays broker 
WITH broker.name = coin.parent
 JOIN BrokersBundle:GlobalParent parent 
 WITH parent.name = broker.parent

');


        $products = $query2->getResult();
        dump($products);



        //return $query->execute();
        return $products;
    }


    public function isDefault()
    {
        $em = $this->getEntityManager();




        $products = $query2->getResult();
        dump($products);



        //return $query->execute();
        return $products;
    }
}