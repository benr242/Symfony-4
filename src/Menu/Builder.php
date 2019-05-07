<?php
/**
 * Created by PhpStorm.
 * User: benr242
 * Date: 5/4/19
 * Time: 12:02 PM
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

//https://symfony.com/doc/current/bundles/KnpMenuBundle/index.html
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('My Menu');

        $menu->addChild('Home', ['route' => 'welcome']);

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();


        $menu->addChild('Latest Blog Post', [
            'route' => 'blog_show',
            'routeParameters' => ['id' => $blog->getId()]
        ]);


        // create another menu item
        $menu->addChild('About Me', ['route' => 'about']);
        // you can also add sub levels to your menus as follows
        $menu['About Me']->addChild('Edit profile', ['route' => 'edit_profile']);

        // ... add more children

        return $menu;
    }
}