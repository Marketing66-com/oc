<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokersArray
 *
 * @ORM\Table(name="brokers_array")
 * @ORM\Entity
 */
class BrokersArray
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
     * @var array
     *
     * @ORM\Column(name="array", type="array", length=0, nullable=false)
     */
    private $array;

    /**
     * @var json
     *
     * @ORM\Column(name="array2", type="json", nullable=false)
     */
    private $array2;

    /**
     * @var array
     *
     * @ORM\Column(name="array3", type="json_array", length=0, nullable=false)
     */
    private $array3;



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

    /**
     * Set array2.
     *
     * @param json $array2
     *
     * @return BrokersArray
     */
    public function setArray2($array2)
    {
        $this->array2 = $array2;

        return $this;
    }

    /**
     * Get array2.
     *
     * @return json
     */
    public function getArray2()
    {
        return $this->array2;
    }

    /**
     * Set array3.
     *
     * @param array $array3
     *
     * @return BrokersArray
     */
    public function setArray3($array3)
    {
        $this->array3 = $array3;

        return $this;
    }

    /**
     * Get array3.
     *
     * @return array
     */
    public function getArray3()
    {
        return $this->array3;
    }
}
