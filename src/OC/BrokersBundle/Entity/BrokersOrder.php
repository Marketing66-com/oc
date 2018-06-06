<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokersOrder
 *
 * @ORM\Table(name="brokers_order")
 * @ORM\Entity
 */
class BrokersOrder
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="broker_id", type="integer", nullable=false)
     */
    private $brokerId;



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
     * Set name.
     *
     * @param string $name
     *
     * @return BrokersOrder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set brokerId.
     *
     * @param int $brokerId
     *
     * @return BrokersOrder
     */
    public function setBrokerId($brokerId)
    {
        $this->brokerId = $brokerId;

        return $this;
    }

    /**
     * Get brokerId.
     *
     * @return int
     */
    public function getBrokerId()
    {
        return $this->brokerId;
    }
}
