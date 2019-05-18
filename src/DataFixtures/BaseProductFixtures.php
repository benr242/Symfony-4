<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BaseProductFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Product::class,   2, function (Product $product, $count){
            $product->setName('Priceless widget:'.$count);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Ok, Many');
        });
    }
}
