<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 13:47
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Address;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddressFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $address = new Address();
        $address->setNumber($faker->numberBetween(0, 100));
        $address->setPath($faker->streetName);
        $address->setPostcode(intval($faker->postcode));
        $address->setCity($faker->city);
        $manager->persist($address);
        $manager->flush();
        $this->setReference('address_1', $address);

        $address2 = new Address();
        $address2->setNumber($faker->numberBetween(0, 100));
        $address2->setPath($faker->streetName);
        $address2->setPostcode(intval($faker->postcode));
        $address2->setCity($faker->city);
        $manager->persist($address2);
        $manager->flush();
        $this->setReference('address_2', $address2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}