<?php

namespace App\DataFixtures\ORM;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadCars
 * @package App\DataFixtures\ORM
 */
class LoadCars extends Fixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createCars($manager);
    }

    protected function createCars(ObjectManager $manager): void
    {
        $car1 = new Car();
        $car1->setPrice(10000);
        $car1->setYear(2019);
        $car1->setNavigation(1);
        $car1->setVendor($this->getReference('Peugeot'));
        $car1->setModel($this->getReference('E-208 GT Electric 50 kWh 136 5dr'));
        $car1->setDescription('Electric Power Steering with Reach and Rake Adjustable Steering Column. Mode 3 Type 2 Cable for Wallbox Charging. Pre-Heating Functionality');
        $car1->setPromote(0);
        $car1->setImage('');


        $car2 = new Car();
        $car2->setPrice(29805);
        $car2->setYear(2019);
        $car2->setNavigation(1);
        $car2->setVendor($this->getReference('Mazda'));
        $car2->setModel($this->getReference('MX-5 RF 2.0 SKYACTIV-G GT Sport Nav+ (s/s) 2dr'));
        $car2->setDescription('This car is brand new and comes with 3 years Mazda Warranty and 3 years Mazda Road Side assistance');
        $car2->setPromote(0);
        $car2->setImage('');

        $car3 = new Car();
        $car3->setPrice(3599950);
        $car3->setYear(2018);
        $car3->setNavigation(1);
        $car3->setVendor($this->getReference('Ferrari'));
        $car3->setModel($this->getReference('Laferrari'));
        $car3->setDescription('Aperta Auto 2dr');
        $car3->setPromote(0);
        $car3->setImage('');

        $manager->persist($car1);
        $manager->persist($car2);
        $manager->persist($car3);

        $manager->flush();
    }
    public function getOrder()
    {
        return 2;
    }
}
