<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/petshop", name="petshop")
 */

class PoroductController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */

    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->json($products);
    }

    /**
     * @Route("/products/{id}", name="product")
     */

    public function getProduct($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->json($product);
    }

    /**
     * @Route("/product/add", name="add_product")
     */

    public function setProduct(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $content = json_decode($request->getContent());
        $product->setName($content->title);
        $product->setDescription($content->description);
        $product->setImg($content->image);
        $product->setPrice($content->price);
        $em->persist($product);
        $em->flush();
        return $this->json("added product");
    }

    /**
     * @Route("/product/update/{id}", name="update_product")
     */

    public function updateProduct(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $content = json_decode($request->getContent());
        dd($request);
        $product->setName($content->title);
        $product->setDescription($content->description);
        $product->setImg($content->image);
        $product->setPrice($content->price);
        $em->persist($product);
        $em->flush();
        return $this->json("added product");
    }

    /**
     * @Route ("/products/delete/{id}", name="delete_product")
     */

    public function deleteProduct($id)
    {
        $existProduct = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if($existProduct){
            $em = $this->getDoctrine()->getManager();
            $em->remove($existProduct);
            $em->flush();
        }
        return new Response(true);
    }

}
