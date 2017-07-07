<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 13:47
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setCategory("Maison");
        $manager->persist($category);
        $manager->flush();
        $this->setReference('cat_1', $category);

        $category2 = new Category();
        $category2->setCategory("Appartement");
        $manager->persist($category2);
        $manager->flush();
        $this->setReference('cat_2', $category2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}