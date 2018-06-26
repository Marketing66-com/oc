<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/26/2018
 * Time: 1:22 PM
 */

namespace OC\BrokersBundle\Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * BrokersOrderArray
 *
 * @ORM\Table(name="brokers_order_array")
 * @ORM\Entity
 */
class BrokersOrderArray
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray($array)
    {
        $this->array = $array;
    }

    /**
     * @var array
     *
     * @ORM\Column(name="array", type="string", length=600, nullable=false)
     */
    private $array;

}