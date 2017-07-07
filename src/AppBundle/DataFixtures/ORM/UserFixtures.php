<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 13:47
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setName($faker->lastName);
        $user->setFirstname($faker->firstNameMale);
        $user->setEmail($faker->email);
        $user->setPassword($faker->password);
        $user->setAddress($this->getReference('address_1'));
        $manager->persist($user);
        $manager->flush();
        $this->setReference('user_1', $user);
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