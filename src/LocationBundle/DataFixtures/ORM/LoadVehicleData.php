<?php

namespace UserBundle\DataFixtures\ORM;

use LocationBundle\Entity\Vehicle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadVehicleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \MattWells\Faker\Vehicle\Provider($faker));

        for ($i = 0; $i < 100; $i++) {

            $vehicle = new Vehicle();

            $vehicle->setBrand($faker->vehicleMake);
            $vehicle->setModel($faker->vehicleModel);
            $vehicle->setSerialNumber(strtoupper($faker->bothify('#??#?###??##?##??')));
            $vehicle->setColor($faker->safeColorName);
            $vehicle->setNumberPlate($faker->vehicleRegistration);
            $vehicle->setKilometer($faker->numberBetween($min = 1000, $max = 100000));
            $vehicle->setDatePurchase($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
            $vehicle->setPricePurchase($faker->randomFloat($nbMaxDemicals = 2, $min = 5000, $max = 1000000));        

            $this->addReference('vehicle' . $i , $vehicle);

            $manager->persist($vehicle);
        }

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 10;
    }
    
}