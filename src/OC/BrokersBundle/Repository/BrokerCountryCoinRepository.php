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
            'SELECT coin.id
 COALESCE(coin.link,broker.link, parent.link)
AS link,
COALESCE(coin.logo,broker.logo, parent.logo)
AS logo,
COALESCE(coin.crypto, broker.crypto, parent.crypto)
AS crypto,
COALESCE(coin.review,broker.review, parent.review)
AS review,
COALESCE(coin.score,broker.score, parent.score)
AS score

 FROM BrokersBundle:BrokerCountryCoin coin 
  JOIN BrokersBundle:BrokerPays broker 
WITH broker.name = coin.parent
 JOIN BrokersBundle:GlobalParent parent 
 WITH parent.name = broker.parent

');


        $products = $query2->getResult();
        //dump($products);



        //return $query->execute();
        return $products;
    }


    public function isDefault()
    {
        $em = $this->getEntityManager();

        $query2 = $em->createQuery(
            'SELECT coin.id,
 COALESCE(coin.link,broker.link, parent.link)
AS link,
CASE WHEN coin.link IS NULL THEN true ELSE false END
AS link_default,

COALESCE(coin.logo,broker.logo, parent.logo)
AS logo,
CASE WHEN coin.logo IS NULL THEN true ELSE false END
AS logo_default,


COALESCE(coin.crypto, broker.crypto, parent.crypto)
AS crypto,
CASE WHEN coin.crypto IS NULL THEN true ELSE false END
AS crypto_default,

COALESCE(coin.review,broker.review, parent.review)
AS review,
CASE WHEN coin.review IS NULL THEN true ELSE false END
AS review_default,

COALESCE(coin.score,broker.score, parent.score)
AS score,
CASE WHEN coin.score IS NULL THEN true ELSE false END
AS score_default



 FROM BrokersBundle:BrokerCountryCoin coin 
  JOIN BrokersBundle:BrokerPays broker 
WITH broker.name = coin.parent
 JOIN BrokersBundle:GlobalParent parent 
 WITH parent.name = broker.parent
');


        $products = $query2->getResult();
        //dump($products);



        return $products;

    }
}