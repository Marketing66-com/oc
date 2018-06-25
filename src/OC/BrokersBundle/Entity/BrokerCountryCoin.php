<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokerCountryCoinRepository
 *
 * @ORM\Table(name="broker_country_coin")
 *  @ORM\Entity(repositoryClass="OC\BrokersBundle\Repository\BrokerCountryCoinRepository")
 */
class BrokerCountryCoin
{
    /**
     * @var int
     *
     * @ORM\Column(name="_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=25, nullable=true)
     */
    private $logo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="review", type="string", length=25, nullable=true)
     */
    private $review;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link", type="string", length=25, nullable=true)
     */
    private $link;

    /**
     * @var int|null
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * @var string|null
     *
     * @ORM\Column(name="crypto", type="string", length=25, nullable=true)
     */
    private $crypto;



    /**
     * @var string|null
     *
     * @ORM\Column(name="parent", type="string", length=25, nullable=true)
     */
    private $parent;



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
     * Set logo.
     *
     * @param string|null $logo
     *
     * @return BrokerCountryCoin
     */
    public function setLogo($logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set review.
     *
     * @param string|null $review
     *
     * @return BrokerCountryCoin
     */
    public function setReview($review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review.
     *
     * @return string|null
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set link.
     *
     * @param string|null $link
     *
     * @return BrokerCountryCoin
     */
    public function setLink($link = null)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set score.
     *
     * @param int|null $score
     *
     * @return BrokerCountryCoin
     */
    public function setScore($score = null)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score.
     *
     * @return int|null
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set crypto.
     *
     * @param string|null $crypto
     *
     * @return BrokerCountryCoin
     */
    public function setCrypto($crypto = null)
    {
        $this->crypto = $crypto;

        return $this;
    }

    /**
     * Get crypto.
     *
     * @return string|null
     */
    public function getCrypto()
    {
        return $this->crypto;
    }

    
    /**
     * Set parent.
     *
     * @param string|null $parent
     *
     * @return BrokerCountryCoin
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function setAny($property,$value)
    {
        $this->{$property} = $value;
    }
}
