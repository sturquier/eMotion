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

        $colors = ['Rouge','Blanc','Gris','Noir', 'Bleu'];
        $brands = ['Nissan', 'Tesla', 'Renault', 'Askoll', 'Govecs'];
        $models = ['Leaf', 'Model_S', 'Model_3', 'Twizy', 'Zoe', 'ES2', 'ES3', 'S15', 'S26', 'S36'];

        for ($i = 0; $i < 100; $i++) {

            $vehicle = new Vehicle();

            foreach ($brands as $brand) {
                foreach ($models as $model) {
                    foreach ($colors as $color) {

                        switch ([$brand, $model, $color]) {
                            case ['Nissan', 'Leaf', 'Blanc']:
                                $vehicle->setBrand('Nissan');
                                $vehicle->setModel('Leaf');
                                $vehicle->setColor('Blanc');
                                $vehicle->setPicture('https://www.nissan-cdn.net/content/dam/Nissan/nissan_europe/range/electric-vehicles/range-electric-vehicles-leaf-zero-emission.jpg.ximg.l_4_h.smart.jpg');
                                break;
                            
                            case ['Tesla', 'Model_S', 'Rouge']:
                                $vehicle->setBrand('Tesla');
                                $vehicle->setModel('Model_S');
                                $vehicle->setColor('Rouge');
                                $vehicle->setPicture('https://www.tesla.com/tesla_theme/assets/img/compare/model_s--side_profile.png?20170524');
                                break;
                            case ['Tesla', 'Model_3', 'Gris']:
                                $vehicle->setBrand('Tesla');
                                $vehicle->setModel('Model_3');
                                $vehicle->setColor('Gris');
                                $vehicle->setPicture('https://www.tesla.com/tesla_theme/assets/img/model3/model_3--side_profile.png?20170801');
                                break;

                            case ['Renault', 'Twizy', 'Blanc']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Twizy');
                                $vehicle->setColor('Blanc');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/FR/webrender-fr/TWIZY/renault_twizy_intens_blanc.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Twizy', 'Rouge']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Twizy');
                                $vehicle->setColor('Rouge');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/FR/webrender-fr/TWIZY/renault_twizy_intens_rouge.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Twizy', 'Noir']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Twizy');
                                $vehicle->setColor('Noir');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/FR/webrender-fr/TWIZY/renault_twizy_life_noir.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Zoe', 'Gris']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Zoe');
                                $vehicle->setColor('Gris');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/master/vehicules/zoe-b10e-ph1/versions-et-prix/zen/renault-zoe-x10-ph1-TEKNV-ZEN-MB%2010R-RTOL16.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Zoe', 'Bleu']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Zoe');
                                $vehicle->setColor('Bleu');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/master/vehicules/zoe-b10e-ph1/versions-et-prix/intens/renault-zoe-x10-ph1-TERQG-INT-MB%2010R-RALU16.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Zoe', 'Noir']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Zoe');
                                $vehicle->setColor('Noir');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/FR/webrender-fr/nouvelle-zoe/Nouvelle_Renault_ZOE-Edition_One.jpg.ximg.l_12_h.smart.jpg');
                                break;
                            case ['Renault', 'Twizy', 'Bleu']:
                                $vehicle->setBrand('Renault');
                                $vehicle->setModel('Twizy');
                                $vehicle->setColor('Bleu');
                                $vehicle->setPicture('https://www.cdn.renault.com/content/dam/Renault/FR/webrender-fr/TWIZY/renault_twizy_intens_bleu.jpg.ximg.l_12_h.smart.jpg');
                                break;

                            case ['Askoll', 'ES2', 'Rouge']:
                                $vehicle->setBrand('Askoll');
                                $vehicle->setModel('ES2');
                                $vehicle->setColor('Rouge');
                                $vehicle->setPicture('http://www.avem.fr/img/scoot/askolles2.jpg');
                                break;
                            case ['Askoll', 'ES3', 'Noir']:
                                $vehicle->setBrand('Askoll');
                                $vehicle->setModel('ES3');
                                $vehicle->setColor('Noir');
                                $vehicle->setPicture('http://www.avem.fr/img/scoot/askolles3.jpg');
                                break;

                            case ['Govecs', 'S15', 'Blanc']:
                                $vehicle->setBrand('Govecs');
                                $vehicle->setModel('S15');
                                $vehicle->setColor('Blanc');
                                $vehicle->setPicture('http://www.avem.fr/img/scoot/govecs_S15.jpg');
                                break;
                            case ['Govecs', 'S26', 'Blanc']:
                                $vehicle->setBrand('Govecs');
                                $vehicle->setModel('S26');
                                $vehicle->setColor('Blanc');
                                $vehicle->setPicture('http://www.avem.fr/img/scoot/govecs_S26.jpg');
                                break;
                            case ['Govecs', 'S36', 'Gris']:
                                $vehicle->setBrand('Govecs');
                                $vehicle->setModel('S36');
                                $vehicle->setColor('Gris');
                                $vehicle->setPicture('http://www.govecs.fr/i/pdt/82/scooter-electrique-125cc-gris.jpg');
                                break;

                        }

                        shuffle($brands);
                        shuffle($models);
                        shuffle($colors);  
                    }
                }
            }

            $vehicle->setSerialNumber(strtoupper($faker->bothify('#??#?###??##?##??')));
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