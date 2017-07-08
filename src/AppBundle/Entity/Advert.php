<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
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
     * @Assert\NotBlank(
     *     message="Vous devez saisir un titre"
     * )
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir une description"
     * )
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(
     *     message="Vous devez choisir une date de construction"
     * )
     *
     * @ORM\Column(name="year", type="date")
     */
    private $year;

    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir une superficie"
     * )
     *
     * @ORM\Column(name="area", type="integer")
     */
    private $area;

    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Vous devez saisir un prix"
     * )
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Category",
     *     inversedBy="adverts",
     *     cascade={"persist"}
     * )
     */
    private $category;

    /**
     * @var Image
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Image",
     *     mappedBy="advert",
     *     cascade={"persist","remove"}
     * )
     */
    private $images;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\User",
     *     inversedBy="adverts"
     * )
     */
    private $user;

    /**
     * @var Address
     *
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\Address",
     *     inversedBy="advert",
     *     cascade={"persist", "remove"}
     * )
     */
    private $address;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Project",
     *     inversedBy="adverts",
     *     cascade={"persist"}
     * )
     */
    private $project;

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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Advert
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set area
     *
     * @param integer $area
     *
     * @return Advert
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return int
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Advert
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Advert
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Advert
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

    /**
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return Advert
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Advert
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
