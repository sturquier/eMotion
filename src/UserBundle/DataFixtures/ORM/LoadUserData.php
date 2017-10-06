<?php

namespace UserBundle\DataFixtures\ORM;

use UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user1 = new User();
        $user1->setUsername('sturquier');
        $user1->setFirstName('simon');
        $user1->setLastName('turquier');
        $user1->setPlainPassword('sturquier');
        $user1->setEnabled(1);
        $user1->setBirthDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $user1->setAddress($faker->address);
        $user1->setPhoneNumber($faker->phoneNumber);
        $user1->setDrivingLicense($faker->bothify('##??#####'));
        $user1->setEmail('turquiersimon@hotmail.fr');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('stitchMoonz');
        $user2->setFirstName('sophie');
        $user2->setLastName('lee');
        $user2->setPlainPassword('stitchMoonz');
        $user2->setEnabled(1);
        $user2->setBirthDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $user2->setAddress($faker->address);
        $user2->setPhoneNumber($faker->phoneNumber);
        $user2->setDrivingLicense($faker->bothify('##??#####'));
        $user2->setEmail('lee.sophie0@gmail.com');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('sailorMoon');
        $user3->setFirstName('sarah');
        $user3->setLastName('abderemane');
        $user3->setPlainPassword('sailorMoon');
        $user3->setEnabled(1);
        $user3->setBirthDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $user3->setAddress($faker->address);
        $user3->setPhoneNumber($faker->phoneNumber);
        $user3->setDrivingLicense($faker->bothify('##??#####'));
        $user3->setEmail('sarahabderemane@gmail.com');
        $manager->persist($user3);
        $manager->flush();

        $user4 = new User();
        $user4->setUsername('kyller92');
        $user4->setFirstName('pathé');
        $user4->setLastName('barry');
        $user4->setPlainPassword('kyller92');
        $user4->setEnabled(1);
        $user4->setBirthDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $user4->setAddress($faker->address);
        $user4->setPhoneNumber($faker->phoneNumber);
        $user4->setDrivingLicense($faker->bothify('##??#####'));
        $user4->setEmail('kyller92@hotmail.fr');
        $manager->persist($user4);
        $manager->flush();

        $adm = new User();
        $adm->setUsername('admin');
        $adm->setFirstName('admin');
        $adm->setLastName('admin');
        $adm->setPlainPassword('admin');
        $adm->setEnabled(1);
        $adm->setBirthDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $adm->setAddress($faker->address);
        $adm->setPhoneNumber($faker->phoneNumber);
        $adm->setDrivingLicense($faker->bothify('##??#####'));
        $adm->setEmail('admin@hotmail.fr');
        $adm->setRoles(array('ROLE_ADMIN'));
        $manager->persist($adm);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 5;
    }
    
}