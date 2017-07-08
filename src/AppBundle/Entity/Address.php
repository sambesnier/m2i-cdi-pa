<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir un numéro de voix"
     * )
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir un type et un nom de voix"
     * )
     *
     * @ORM\Column(name="path", type="string", length=50)
     */
    private $path;

    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir un code postal"
     * )
     *
     * @ORM\Column(name="postcode", type="integer")
     */
    private $postcode;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir une ville"
     * )
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;

    /**
     * @var Advert
     *
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\Advert",
     *     mappedBy="address"
     * )
     */
    private $advert;

    /**
     * @var User
     *
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\User",
     *     mappedBy="address"
     * )
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Address
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     *
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return int
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return Address
     */
    public function setAdvert(\AppBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \AppBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Address
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
