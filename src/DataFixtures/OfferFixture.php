<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class OfferFixture extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        $offer = new Offer();
        $offer->setName('10% Off');
        $offer->setDescription('10% Off on any products');
        $offer->setValue(10);
        $offer->setIsFixed(FALSE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-5 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+5 days'));
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setName('20% Off');
        $offer->setDescription('20% Off on any products');
        $offer->setValue(20);
        $offer->setIsFixed(FALSE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-30 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+30 days'));
        $manager->persist($offer);  
        
        $offer = new Offer();
        $offer->setName('25% Off');
        $offer->setDescription('20% Off on selected products');
        $offer->setValue(25);
        $offer->setIsFixed(FALSE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-30 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+30 days'));
        $manager->persist($offer);  

        $offer = new Offer();
        $offer->setName('2 EURO Off');
        $offer->setDescription('10 EURO off on selected products');
        $offer->setValue(2);
        $offer->setIsFixed(TRUE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-30 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+30 days'));
        $manager->persist($offer); 

        $offer = new Offer();
        $offer->setName('5 EURO Off');
        $offer->setDescription('10 EURO off on selected products');
        $offer->setValue(5);
        $offer->setIsFixed(TRUE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-30 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+30 days'));
        $manager->persist($offer); 

        $offer = new Offer();
        $offer->setName('10 EURO Off');
        $offer->setDescription('10 EURO off on selected products');
        $offer->setValue(10);
        $offer->setIsFixed(TRUE);
        $offer->setIsActive(TRUE);
        $offer->setStartsAt($this->faker->datetimeBetween('-15 days', 'now'));
        $offer->setExpiresAt($this->faker->datetimeBetween('now', '+15 days'));
        $manager->persist($offer); 

        $manager->flush();
    }
}
