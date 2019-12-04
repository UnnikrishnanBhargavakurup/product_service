<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CustomerFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName('Patricia S. Kemp');
        $customer->setStreet('3347 Duck Creek Road');
        $customer->setCity('Palo Alto, CA 94306');
        $customer->setPhone('650-813-0200');
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName('Wilfredo N. Croft');
        $customer->setStreet('3849 Emeral Dreams Drive');
        $customer->setCity('Seward, IL 61063');
        $customer->setPhone('815-247-4027');
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName('Marc Beauchemin');
        $customer->setStreet('15, Rue du Limas');
        $customer->setCity('21200 BEAUNE');
        $customer->setPhone('03.28.14.71.40');
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName('Hugues Bureau');
        $customer->setStreet('64, rue Reine Elisabeth');
        $customer->setCity('48000 MENDE');
        $customer->setPhone('04.62.86.54.80');
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName('Dolcelino Pisano');
        $customer->setStreet('Via Partenope, 114');
        $customer->setCity('47010-Terra Del Sole FO');
        $customer->setPhone('0343 3604763');
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName('Steffen Bader');
        $customer->setStreet('Brandenburgische Straße 85');
        $customer->setCity('13059 Berlin Hohenschönhausen');
        $customer->setPhone('030 18 17 74');
        $manager->persist($customer);

        $manager->flush();
    }
}
