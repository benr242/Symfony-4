<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }

    /**
     * @Route("hello", name="hello-page")
     */
    public function hello()
    {
        $this->addFlash('success', 'My new hello flosh');
        return $this->render('welcome/hello.html.twig');
    }

    /**
     * @Route("orm", name="orm")
     */
    public function orm()
    {
        return $this->render('orm/index.html.twig');
    }


}
