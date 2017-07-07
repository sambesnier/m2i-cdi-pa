<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 12:23
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Advert;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdvertFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $advert = new Advert();
        $advert->setProject($this->getReference('proj_1'));
        $advert->setContent($faker->text(150));
        $advert->setAddress($this->getReference('address_1'));
        $advert->setArea($faker->numberBetween(35, 150));
        $advert->setCategory($this->getReference('cat_1'));
        $advert->setPrice($faker->numberBetween(120000, 250000));
        $advert->setYear(new \DateTime('today - 30 year'));
        $advert->setUser($this->getReference('user_1'));
        $advert->setTitle("Maison de caractère très bien située");
        $manager->persist($advert);
        $manager->flush();

        $advert2 = new Advert();
        $advert2->setProject($this->getReference('proj_2'));
        $advert2->setContent($faker->text(150));
        $advert2->setAddress($this->getReference('address_2'));
        $advert2->setArea($faker->numberBetween(35, 150));
        $advert2->setCategory($this->getReference('cat_2'));
        $advert2->setPrice($faker->numberBetween(350, 700));
        $advert2->setYear(new \DateTime('today - 21 year'));
        $advert2->setUser($this->getReference('user_1'));
        $advert2->setTitle("Très bel appartement T3");
        $manager->persist($advert2);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}