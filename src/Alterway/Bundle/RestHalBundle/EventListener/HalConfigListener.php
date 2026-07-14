<?php

namespace Alterway\Bundle\RestHalBundle\EventListener;

use Alterway\Bundle\RestHalBundle\Controller\Annotations\Hal;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class HalConfigListener
{
    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        if (!\is_array($controller)) {
            return;
        }

        [$controllerObject, $method] = $controller;

        $attributes = (new \ReflectionMethod($controllerObject, $method))->getAttributes(Hal::class);

        if (!$attributes) {
            return;
        }

        $event->getRequest()->attributes->set('_hal_config', $attributes[0]->newInstance());
    }
}
