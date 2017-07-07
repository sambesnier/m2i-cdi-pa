<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="project", type="string", length=20, unique=true)
     */
    private $project;

    /**
     * @var Advert
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Advert",
     *     mappedBy="project"
     * )
     */
    private $adverts;


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
     * Set project
     *
     * @param string $project
     *
     * @return Project
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set adverts
     *
     * @param \AppBundle\Entity\Advert $adverts
     *
     * @return Project
     */
    public function setAdverts(\AppBundle\Entity\Advert $adverts = null)
    {
        $this->adverts = $adverts;

        return $this;
    }

    /**
     * Get adverts
     *
     * @return \AppBundle\Entity\Advert
     */
    public function getAdverts()
    {
        return $this->adverts;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adverts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return Project
     */
    public function addAdvert(\AppBundle\Entity\Advert $advert)
    {
        $this->adverts[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \AppBundle\Entity\Advert $advert
     */
    public function removeAdvert(\AppBundle\Entity\Advert $advert)
    {
        $this->adverts->removeElement($advert);
    }
}
