<?php

namespace App\DataFixtures\ORM;

use App\Entity\Model;
use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadDictionary
 * @package App\DataFixtures\ORM
 */
class LoadDictionary extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createVendors($manager);
        $this->createModels($manager);
    }

    protected function createVendors(ObjectManager $manager): void
    {
        $vendor1 = new Vendor();
        $vendor1->setName('Peugeot');

        $vendor2 = new Vendor();
        $vendor2->setName('Mazda');

        $vendor3 = new Vendor();
        $vendor3->setName('Ferrari');

        $vendor4 = new Vendor();
        $vendor4->setName('BMW');

        $vendor5 = new Vendor();
        $vendor5->setName('Toyota');

        $vendor6 = new Vendor();
        $vendor6->setName('Hyundai');

        $vendor7 = new Vendor();
        $vendor7->setName('Audi');

        $manager->persist($vendor1);
        $manager->persist($vendor2);
        $manager->persist($vendor3);
        $manager->persist($vendor4);
        $manager->persist($vendor5);
        $manager->persist($vendor6);
        $manager->persist($vendor7);

        $manager->flush();

        $this->addReference('Peugeot', $vendor1);
        $this->addReference('Mazda', $vendor2);
        $this->addReference('Ferrari', $vendor3);
    }

    protected function createModels(ObjectManager $manager): void
    {
        $model1 = new Model();
        $model1->setName('E-208 GT Electric 50 kWh 136 5dr');

        $model2 = new Model();
        $model2->setName('MX-5 RF 2.0 SKYACTIV-G GT Sport Nav+ (s/s) 2dr');

        $model3 = new Model();
        $model3->setName('Laferrari');

        $model4 = new Model();
        $model4->setName('X5');

        $model5 = new Model();
        $model5->setName('Camry');

        $model6 = new Model();
        $model6->setName('i30');

        $model7 = new Model();
        $model7->setName('A3');

        $manager->persist($model1);
        $manager->persist($model2);
        $manager->persist($model3);
        $manager->persist($model4);
        $manager->persist($model5);
        $manager->persist($model6);
        $manager->persist($model7);

        $manager->flush();

        $this->addReference('E-208 GT Electric 50 kWh 136 5dr', $model1);
        $this->addReference('MX-5 RF 2.0 SKYACTIV-G GT Sport Nav+ (s/s) 2dr', $model2);
        $this->addReference('Laferrari', $model3);
    }
    public function getOrder()
    {
        return 1;
    }
}
