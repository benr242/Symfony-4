<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(MessageGenerator $mg)
    {
        $randomMsq = $mg->getHappyMessage();

        return $this->render('welcome/index.html.twig', [
            'happyMessage' => $randomMsq,
            'controller_name' => 'WelcomeController',
        ]);
    }

    /**
     * @Route("hello", name="hello-page")
     */
    public function hello()
    {
        $this->addFlash('success', 'My new hello flash');
        return $this->render('welcome/hello.html.twig');
    }
}
