<?php

namespace LocationBundle\DataFixtures\ORM;

use LocationBundle\Entity\Vehicle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadVehicleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \MattWells\Faker\Vehicle\Provider($faker));

        $colors = ['Rouge','Blanc','Gris','Noir','Marron','Bleu'];

        for ($i = 0; $i < 100; $i++) {

            $vehicle = new Vehicle();

            $vehicle->setBrand($faker->vehicleMake);
            $vehicle->setModel($faker->vehicleModel);
            $vehicle->setSerialNumber(strtoupper($faker->bothify('#??#?###??##?##??')));

            foreach ($colors as $color) {
                $vehicle->setColor($color);

                switch ($color) {
                    case 'Rouge':
                        $vehicle->setPicture('http://eskipaper.com/images/red-car-1.jpg');
                        break;
                    
                    case 'Blanc':
                        $vehicle->setPicture('http://eskipaper.com/images/white-car-1.jpg');
                        break;

                    case 'Gris':
                        $vehicle->setPicture('https://thumbs.dreamstime.com/b/vue-de-c-t%C3%A9-de-voiture-grise-49336430.jpg');
                        break;

                    case 'Noir':
                        $vehicle->setPicture('http://eskipaper.com/images/black-car-2.jpg');
                        break;

                    case 'Marron':
                        $vehicle->setPicture('https://i2.cdscdn.com/pdt2/9/0/6/3/300x300/nor7426807700906/rw/renault-talisman-de-2016-marron-vison-voiture-de-c.jpg');
                        break;

                    default:
                        $vehicle->setPicture('http://eskipaper.com/images/blue-car-1.jpg');
                        break;
                }
            }
            shuffle($colors);

            $vehicle->setNumberPlate($faker->vehicleRegistration);
            $vehicle->setNumberPlate(strtoupper($faker->bothify('??-###-?? ##')));
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