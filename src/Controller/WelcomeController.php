<?php

namespace App\Controller;

use App\Menu\Builder;
use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(MessageGenerator $mg, Builder $builder)
    {
        $session = new Session(new NativeSessionStorage(), new AttributeBag());

        $randomMsq = $mg->getHappyMessage();

        $menu = $builder->mainMenu();

        return $this->render('welcome/index.html.twig', [
            'test' => 'test',
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
        //$this->addFlash('succes', )
        //$this->addFlash('success', $navbase);
        return $this->render('welcome/hello.html.twig', [
            'menu' => '_orm_'
        ]);
    }
}
