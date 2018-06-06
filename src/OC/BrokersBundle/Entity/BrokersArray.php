<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokersArray
 *
 * @ORM\Table(name="brokers_array")
 * @ORM\Entity(repositoryClass="OC\BrokersBundle\Repository\BrokersArrayRepository")
 */
class BrokersArray
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="array", type="array")
     */
    private $array;





    /**
     * @var array2
     *
     * @ORM\Column(name="array2", type="json")
     */
    private $array2;



    /**
     * @var array3
     *
     * @ORM\Column(name="array3", type="json_array")
     */
    private $array3;

    /**
     * @return array
     */
    public function getArray2()
    {
        return $this->array2;
    }

    /**
     * @param array $array2
     */
    public function setArray2($array2)
    {
        $this->array2 = $array2;
    }

    /**
     * @return array
     */
    public function getArray3()
    {
        return $this->array3;
    }

    /**
     * @param array $array3
     */
    public function setArray3($array3)
    {
        $this->array3 = $array3;
    }












    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set array.
     *
     * @param array $array
     *
     * @return BrokersArray
     */
    public function setArray($array)
    {
        $this->array = $array;

        return $this;
    }

    /**
     * Get array.
     *
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }
}
