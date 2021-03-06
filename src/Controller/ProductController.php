<?php

namespace App\Controller;

use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("orm", name="orm")
     */
    public function orm()
    {
        $session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session->set('nav', 'orm');

        //$this->addFlash('success', {{ nav-base}});

        return $this->render('orm/index.html.twig', [
            'controller_class' => 'ProductController',
        ]);
    }

    /**
     * @Route("/orm/product", name="orm-product")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // $this->addFlash('success', $navbase);

        return $this->redirectToRoute('orm-show');
/*
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
*/
    }

    /**
     * @Route("/orm/new", name="orm-new")
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('orm-show');
        }

        return $this->render('product/add.html.twig', [
           'my_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/orm/show", name="orm-show")
     */
    public function showDummy()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('orm/show.html.twig', [
            'products' => $products,
        ]);
    }


    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
