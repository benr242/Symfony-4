<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BaseProductFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $myname = "ben";

        $this->createMany(Product::class,       5, function (Product $product, $count) use ($manager, $myname){
            $product->setName('Priceless widget:'.$count.$myname);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Ok, Many');
        });
    }
}
