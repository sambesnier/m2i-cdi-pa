<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 07/07/2017
 * Time: 12:23
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Advert;
use AppBundle\Entity\Image;
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
        $image = new Image();
        $image->setUrl('https://s-media-cache-ak0.pinimg.com/originals/f5/b2/53/f5b25368d26fe04b848ad2ef532b2e0f.jpg');
        $image->setAlt('Photo habitation');

        $image2 = new Image();
        $image2->setUrl('http://www.depreux-construction.com/1390-large/constructeur-de-maison-individuelle-et-terrain-a-batir-en-loire-atlantique-44-et-vendee-85-1390.jpg');
        $image2->setAlt('Photo habitation');

        $image3 = new Image();
        $image3->setUrl('http://www.eiffage-immobilier.fr/files/live/sites/eiffage-immo/files/contributed/visuels-programmes/appartement-neuf-nice-stella-rocca-diapo4.jpg');
        $image3->setAlt('Photo habitation');

        $image4 = new Image();
        $image4->setUrl('http://www.domaine-de-capelongue.com/wp-content/uploads/2014/02/Appartement-Mezzanine.jpg');
        $image4->setAlt('Photo habitation');

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

        $image->setAdvert($advert);
        $image2->setAdvert($advert);
        $advert->addImage($image);
        $advert->addImage($image2);

        $manager->persist($advert);
        $manager->flush();
        $this->setReference('advert_1', $advert);

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

        $image3->setAdvert($advert2);
        $image4->setAdvert($advert2);
        $advert2->addImage($image3);
        $advert2->addImage($image4);

        $manager->persist($advert2);
        $manager->flush();
        $this->setReference('advert_2', $advert2);

        $manager->persist($image);
        $manager->persist($image2);
        $manager->persist($image3);
        $manager->persist($image4);
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