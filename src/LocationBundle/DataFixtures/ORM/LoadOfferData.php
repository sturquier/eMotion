<?php

namespace UserBundle\DataFixtures\ORM;

use LocationBundle\Entity\Offer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadOfferData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {

            $offer = new Offer();
            $offer->setPriceLocation($faker->numberBetween($min = 10, $max = 150));
            $offer->setDateBegin($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
            $offer->setDateEnd($faker->dateTime($min ='now', $max = '+30 years', $timezone = date_default_timezone_get()));

            $this->addReference('offer' . $i , $offer);

            $manager->persist($offer);
        }

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 10;
    }
    
}