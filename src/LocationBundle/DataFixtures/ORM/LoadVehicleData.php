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

                $rand_vehicle = mt_rand(0,2);
                switch ([$color, $rand_vehicle]) {
                    case ['Rouge', 0]:
                        $vehicle->setPicture('http://eskipaper.com/images/red-car-1.jpg');
                        break;
                    case ['Rouge', 1]:
                        $vehicle->setPicture('https://img.autoplus.fr/news/2017/09/07/1519962/1200%7C800%7Cbde393fddc25ef4523470cd8.jpg');
                        break;
                    case ['Rouge', 2]:
                        $vehicle->setPicture('https://www.mazdausa.com/siteassets/vehicles/2018/m3s/vlp/studio-360s/soul-red/my18_m3s_gt_41v_soul_red-018.jpg');
                        break;

                    case ['Blanc', 0]:
                        $vehicle->setPicture('http://eskipaper.com/images/white-car-1.jpg');
                        break;
                    case ['Blanc', 1]:
                        $vehicle->setPicture('http://eskipaper.com/images/white-car-3.jpg');
                        break;
                    case ['Blanc', 2]:
                        $vehicle->setPicture('http://eskipaper.com/images/white-car-4.jpg');
                        break;

                    case ['Gris', 0]:
                        $vehicle->setPicture('https://thumbs.dreamstime.com/b/vue-de-c-t%C3%A9-de-voiture-grise-49336430.jpg');
                        break;
                    case ['Gris', 1]:
                        $vehicle->setPicture('https://thumbs.dreamstime.com/b/metallic-grey-car-side-view-high-resolution-render-d-42658445.jpg');
                        break;
                    case ['Gris', 2]:
                        $vehicle->setPicture('https://carwow-uk-wp-0.imgix.net/sharkgrey.jpeg?ixlib=rb-1.1.0&fit=crop&w=1600&h=&q=60&cs=tinysrgb&auto=format');
                        break;

                    case ['Noir', 0]:
                        $vehicle->setPicture('http://eskipaper.com/images/black-car-2.jpg');
                        break;
                    case ['Noir', 1]:
                        $vehicle->setPicture('http://www.blackcarlimo.ca/wp-content/uploads/2015/11/lincoln-mks.jpg');
                        break;
                    case ['Noir', 2]:
                        $vehicle->setPicture('https://irp-cdn.multiscreensite.com/37db6128/dms3rep/multi/desktop/2014-E-CLASS-E250-BLUETEC-SEDAN-BASE-MH1-D-1440x600.png');
                        break;

                    case ['Marron', 0]:
                        $vehicle->setPicture('http://aws-cf.caradisiac.com/prod/mesimages/313182/Koleos%20Marron%20Cuivre%20TE.jpg');
                        break;
                    case ['Marron', 1]:
                        $vehicle->setPicture('https://www.actualite-voitures.fr/wp-content/uploads/2011/02/voiture-renault-clio-xv.jpg');
                        break;
                    case ['Marron', 2]:
                        $vehicle->setPicture('http://photos.autocadre.com/images/actualites/photos/Renault-xv-de-france-2011-2.jpg');
                        break;

                    case ['Bleu', 0]:
                        $vehicle->setPicture('https://i.pinimg.com/originals/e7/48/f4/e748f4f3dcb80193913ce7fadbf7307c.png');
                        break;
                    case ['Bleu', 1]:
                        $vehicle->setPicture('https://us.123rf.com/450wm/podsolnukh/podsolnukh1207/podsolnukh120700031/14441902-bleu-voiture-moderne.jpg?ver=6');
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