<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('Motorola XOOM with Wi-Fi');
        $product->setPrice(200);
        $product->setStock(50);
        $product->setIsActive(TRUE);
        $product->setDescription("The Next, Next Generation Experience the future with Motorola XOOM with Wi-Fi, the world's first tablet powered by Android 3.0 (Honeycomb).");
        $manager->persist($product);

        $product = new Product();
        $product->setName('MOTOROLA ATRIX');
        $product->setPrice(150);
        $product->setStock(150);
        $product->setIsActive(TRUE);
        $product->setDescription("MOTOROLA ATRIX 4G the world's most powerful smartphone.");
        $manager->persist($product);

        $product = new Product();
        $product->setName('Dell Streak 7');
        $product->setPrice(180);
        $product->setStock(20);
        $product->setIsActive(TRUE);
        $product->setDescription("Introducing Dell Streak 7. Share photos, videos and movies together. It\u2019s small enough to carry around, big enough to gather around.");
        $manager->persist($product);

        $product = new Product();
        $product->setName('Dell Venue');
        $product->setPrice(160);
        $product->setStock(70);
        $product->setIsActive(TRUE);
        $product->setDescription("The Dell Venue; Your Personal Express Lane to Everything");
        $manager->persist($product);   

        $product = new Product();
        $product->setName('MUSTACHES MOTO G5S PLUS MOBILE COVER');
        $product->setPrice(10);
        $product->setStock(100);
        $product->setIsActive(TRUE);
        $product->setDescription("Light, Durable Polycarbonate Hard Case. Includes cut-outs for your regular charger and headphones. 6 Months No-Hassle Warranty");
        $manager->persist($product);  

        $product = new Product();
        $product->setName('HOPE MOTO G5S PLUS MOBILE COVER');
        $product->setPrice(15);
        $product->setStock(100);
        $product->setIsActive(TRUE);
        $product->setDescription("The serene nature of the HOPE Phone Case depicts the sole reason of buying and equipping it on your respective smartphone.");
        $manager->persist($product);

        $product = new Product();
        $product->setName('TRAVEL WORLD MAP MOTO G5S PLUS BACK COVER');
        $product->setPrice(15);
        $product->setStock(100);
        $product->setIsActive(TRUE);
        $product->setDescription("Holidays can either be about staying in or about making travel memories.");
        $manager->persist($product);

        $product = new Product();
        $product->setName('BATARANG MOTO G5S PLUS BACK COVER');
        $product->setPrice(15);
        $product->setStock(100);
        $product->setIsActive(TRUE);
        $product->setDescription("The Batarang has now become a symbol of POWER, HOPE, BRAVERY, and SELF DEFENSE.");
        $manager->persist($product);

        $product = new Product();
        $product->setName('Motorola G5s Plus (Lunar Grey, 64GB)');
        $product->setPrice(100);
        $product->setStock(20);
        $product->setIsActive(TRUE);
        $product->setDescription("Camera: 13+13 MP Dual rear camera with LED flash | 8 MP front camera with flash");
        $manager->persist($product);

        $product = new Product();
        $product->setName('Motorola G7 Power (Black, 4GB RAM, 64GB Storage)');
        $product->setPrice(120);
        $product->setStock(20);
        $product->setIsActive(TRUE);
        $product->setDescription("12MP primary camera with f2.0, PDAF, 1.25micrometer pixels, burst shot, auto HDR, timer, ZSL, high-res zoom, cinemagraph, portrait mode, panorama, manual mode, RAW photo output");
        $manager->persist($product);

        $manager->flush();
    }
}
