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

            $nb_offers = mt_rand(0, 4);
            $ref_vehicle = $this->getReference('vehicle' . $i);

            while ($nb_offers > 0) {
                
                $offer = new Offer();
                $offer->setPriceLocation($faker->numberBetween($min = 10, $max = 150));
                $offer->setDateBegin($faker->dateTimeBetween($starDate = 'now', $endDate = '+10 days', $timezone = date_default_timezone_get()));
                $offer->setDateEnd($faker->dateTimeBetween($starDate ='+11 days', $endDate = '+30 days', $timezone = date_default_timezone_get()));

                $offer->setVehicle($ref_vehicle);

                $manager->persist($offer);

                $nb_offers--;
            }
        }

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 15;
    }
    
}