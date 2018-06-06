<?php

namespace OC\BrokersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalParent
 *
 * @ORM\Table(name="global_parent")
 * @ORM\Entity(repositoryClass="OC\BrokersBundle\Repository\GlobalParentRepository")
 */
class GlobalParent
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
     * @ORM\Column(name="name", type="string", length=25, nullable=true)
     */
    private $name;

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
     * @ORM\Column(name="link", type="string", length=11, nullable=true)
     */
    private $link;

    /**
     * @var float|null
     *
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=true)
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
     * @ORM\Column(name="display_name", type="string", length=25, nullable=true)
     */
    private $displayName;



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
     * @param string|null $name
     *
     * @return GlobalParent
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logo.
     *
     * @param string|null $logo
     *
     * @return GlobalParent
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
     * @return GlobalParent
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
     * @return GlobalParent
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
     * @param float|null $score
     *
     * @return GlobalParent
     */
    public function setScore($score = null)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score.
     *
     * @return float|null
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
     * @return GlobalParent
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
     * Set displayName.
     *
     * @param string|null $displayName
     *
     * @return GlobalParent
     */
    public function setDisplayName($displayName = null)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}
