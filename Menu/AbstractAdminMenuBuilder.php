<?php

namespace Intbizth\Bundle\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Sylius\Bundle\UiBundle\Menu\AbstractMenuBuilder;
use Sylius\Component\Rbac\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractAdminMenuBuilder extends AbstractMenuBuilder
{
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @param FactoryInterface $factory
     * @param EventDispatcherInterface $eventDispatcher
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FactoryInterface $factory,
        EventDispatcherInterface $eventDispatcher,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        parent::__construct($factory, $eventDispatcher);

        $this->authorizationChecker = $authorizationChecker;
    }
}
