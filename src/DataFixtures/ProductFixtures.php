<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0;$i < 8;$i++)
        {
            $product = new Product();
            $product->setName('Priceless widget:'.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Ok, I guess it *does* have a price');

            $manager->persist($product);
        }

        $manager->flush();
    }
}
