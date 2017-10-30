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
            }
            shuffle($colors);

            $vehicle->setNumberPlate($faker->vehicleRegistration);
            $vehicle->setNumberPlate(strtoupper($faker->bothify('??-###-?? ##')));
            $vehicle->setKilometer($faker->numberBetween($min = 1000, $max = 100000));
            $vehicle->setDatePurchase($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
            $vehicle->setPricePurchase($faker->randomFloat($nbMaxDemicals = 2, $min = 5000, $max = 1000000));        



            $file = new File(__DIR__.'/../../../../web/uploads/vehicules/voiture_blanche_un.jpg', 'nom_du_fichier.jpg');
            
            dump($this->get('kernel')->getRootDir());
            $vehicle->setPicture($file);




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