<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        foreach($this->getProductData() as [$title, $description, $img, $price, $user_id,$created_at])
        {
            $user = $manager->getRepository(User::class)->find($user_id);
            $product = new Product();
            $product->setName($title);
            $product->setDescription($description);
            $product->setImg($img);
            $product->setPrice($price);
            $product->setUser($user);
            $product->setCreatedAt($created_at);
            $manager->persist($product);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    private function getProductData()
    {
        return [
            ['Product Title', 'Product description',  'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jp', 122,1,new \DateTime()],
            ['Product Title2', 'Product description',  'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jp', 122,1,new \DateTime()],
            ['Product Title3', 'Product description',  'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jp', 122,1,new \DateTime()],
        ];
    }
}
