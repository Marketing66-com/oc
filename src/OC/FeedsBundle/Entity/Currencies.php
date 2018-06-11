<?php

namespace OC\FeedsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currencies
 *
 * @ORM\Table(name="currencies")
 * @ORM\Entity(repositoryClass="OC\FeedsBundle\Repository\CurrenciesRepository")
 */
class Currencies
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
     * @var string
     *
     * @ORM\Column(name="from_symbol", type="string", length=255)
     */
    private $fromSymbol;

    /**
     * @var string
     *
     * @ORM\Column(name="to_symbol", type="string", length=255)
     */
    private $toSymbol;

    /**
     * @var string
     *
     * @ORM\Column(name="exchanges", type="string", length=255)
     */
    private $exchanges;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


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
     * Set fromSymbol.
     *
     * @param string $fromSymbol
     *
     * @return Currencies
     */
    public function setFromSymbol($fromSymbol)
    {
        $this->fromSymbol = $fromSymbol;

        return $this;
    }

    /**
     * Get fromSymbol.
     *
     * @return string
     */
    public function getFromSymbol()
    {
        return $this->fromSymbol;
    }

    /**
     * Set toSymbol.
     *
     * @param string $toSymbol
     *
     * @return Currencies
     */
    public function setToSymbol($toSymbol)
    {
        $this->toSymbol = $toSymbol;

        return $this;
    }

    /**
     * Get toSymbol.
     *
     * @return string
     */
    public function getToSymbol()
    {
        return $this->toSymbol;
    }

    /**
     * Set exchanges.
     *
     * @param string $exchanges
     *
     * @return Currencies
     */
    public function setExchanges($exchanges)
    {
        $this->exchanges = $exchanges;

        return $this;
    }

    /**
     * Get exchanges.
     *
     * @return string
     */
    public function getExchanges()
    {
        return $this->exchanges;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Currencies
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
