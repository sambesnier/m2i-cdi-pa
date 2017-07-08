<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 13:47
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setProject("Achat");
        $manager->persist($project);
        $manager->flush();
        $this->setReference('proj_1', $project);

        $project2 = new Project();
        $project2->setProject("Location");
        $manager->persist($project2);
        $manager->flush();
        $this->setReference('proj_2', $project2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}