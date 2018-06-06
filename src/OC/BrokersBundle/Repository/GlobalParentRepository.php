<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/6/2018
 * Time: 1:03 PM
 */

namespace OC\BrokersBundle\Repository;
use OC\BrokersBundle\Entity\GlobalParent;
use Doctrine\ORM\EntityRepository;


class GlobalParentRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}