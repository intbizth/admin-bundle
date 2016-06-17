<?php

namespace Intbizth\Bundle\AdminBundle\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class MainMenuBuilder extends AbstractAdminMenuBuilder
{
    const EVENT_NAME = 'intbizth.menu.admin.main';

    /**
     * @return ItemInterface
     */
    public function createMenu()
    {
        $menu = $this->factory->createItem('root');

        $this->addConfigurationMenu($menu);

        $this->eventDispatcher->dispatch(self::EVENT_NAME, new MenuBuilderEvent($this->factory, $menu));

        return $menu;
    }

    /**
     * Permission Check
     *
     * @param string $permission
     *
     * @return bool
     */
    protected function isGranted($permission)
    {
        return $this->authorizationChecker->isGranted($permission);
    }

    /**
     * @param ItemInterface $menu
     */
    private function addConfigurationMenu(ItemInterface $menu)
    {
        $child = $menu
            ->addChild('configuration')
            ->setLabel('Configuration')
        ;

        if ($this->isGranted('sylius.manage.channel')) {
//            $child
//                ->addChild('channels', ['route' => 'sylius_admin_channel_index'])
//                ->setLabel('Channels')
//                ->setLabelAttribute('icon', 'sitemap')
//            ;
        }
    }
}
