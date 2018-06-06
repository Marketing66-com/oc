<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/22/2018
 * Time: 2:32 PM
 */

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="oc_broker_image")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\BrokerImageRepository")
 */
class BrokerImage
{


    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @ORM\Column(name="url", type="string", length=255)
     *
     *  * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     */
    protected $image;

    public function setImage(File $file = null)
    {
        $this->image = $file;
    }

    public function getImage()
    {
        return $this->image;
    }
}