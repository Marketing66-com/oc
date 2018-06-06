<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Broker
 *
 * @ORM\Table(name="broker")
 * @ORM\Entity(repositoryClass="OC\BrokersBundle\Repository\BrokerRepository")
 */
class Broker
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="site_link", type="string", length=255)
     */
    private $siteLink;

    /**
     * @return string
     */
    public function getReviewLink()
    {
        return $this->reviewLink;
    }

    /**
     * @param string $reviewLink
     */
    public function setReviewLink($reviewLink)
    {
        $this->reviewLink = $reviewLink;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="review_link", type="string", length=255)
     */
    private $reviewLink;



    /**
     * @var string
     *
     * @ORM\Column(name="crypto_image", type="string", length=255)
     */
    private $cryptoImage;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var float
     *
     * @ORM\Column(name="min_depot", type="float")
     */
    private $minDepot;

    /**
     * @var string
     *
     * @ORM\Column(name="regulation_img", type="string", length=255)
     */
    private $regulationImg;

    /**
     * @var float
     *
     * @ORM\Column(name="user_score", type="float")
     */
    private $userScore;


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
     * @return Broker
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
     * Set siteLink.
     *
     * @param string $siteLink
     *
     * @return Broker
     */
    public function setSiteLink($siteLink)
    {
        $this->siteLink = $siteLink;

        return $this;
    }

    /**
     * Get siteLink.
     *
     * @return string
     */
    public function getSiteLink()
    {
        return $this->siteLink;
    }

    /**
     * Set cryptoImage.
     *
     * @param string $cryptoImage
     *
     * @return Broker
     */
    public function setCryptoImage($cryptoImage)
    {
        $this->cryptoImage = $cryptoImage;

        return $this;
    }

    /**
     * Get cryptoImage.
     *
     * @return string
     */
    public function getCryptoImage()
    {
        return $this->cryptoImage;
    }

    /**
     * Set logo.
     *
     * @param string $logo
     *
     * @return Broker
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set minDepot.
     *
     * @param float $minDepot
     *
     * @return Broker
     */
    public function setMinDepot($minDepot)
    {
        $this->minDepot = $minDepot;

        return $this;
    }

    /**
     * Get minDepot.
     *
     * @return float
     */
    public function getMinDepot()
    {
        return $this->minDepot;
    }

    /**
     * Set regulationImg.
     *
     * @param string $regulationImg
     *
     * @return Broker
     */
    public function setRegulationImg($regulationImg)
    {
        $this->regulationImg = $regulationImg;

        return $this;
    }

    /**
     * Get regulationImg.
     *
     * @return string
     */
    public function getRegulationImg()
    {
        return $this->regulationImg;
    }

    /**
     * Set userScore.
     *
     * @param float $userScore
     *
     * @return Broker
     */
    public function setUserScore($userScore)
    {
        $this->userScore = $userScore;

        return $this;
    }

    /**
     * Get userScore.
     *
     * @return float
     */
    public function getUserScore()
    {
        return $this->userScore;
    }



    /**
     * Get any.
     *
     */
    public function getAny($attribute_name)
    {
        return $this->{$attribute_name};
    }


    /**
     * Get setAny.
     *
     */
    public function setAny($attribute_name, $attribute_value)
    {
        $this->{$attribute_name} = $attribute_value;
        return $this;
    }
}
