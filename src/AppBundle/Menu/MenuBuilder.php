<?php

// src/AppBundle/Menu/MenuBuilder.php

namespace App\AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('main');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');


        $menu->addChild('Autotrader',
            [
                'route'      => 'homepage',
                'attributes' => ['class' => 'nav-item'],
                'linkAttributes' => ['class' => 'nav-link']
            ]
        );

        $menu->addChild('Car',
            [
                'route'      => 'car',
                'attributes' => ['class' => 'nav-item'],
                'linkAttributes' => ['class' => 'nav-link']
            ]
        );

        $menu->addChild('Offer',
            [
                'route'      => 'offer',
                'attributes' => ['class' => 'nav-item'],
                'linkAttributes' => ['class' => 'nav-link']
            ]
        );

        // ... add more children

        return $menu;
    }
}