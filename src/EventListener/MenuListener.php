<?php

namespace App\EventListener;

use SumoCoders\FrameworkCoreBundle\Event\ConfigureMenuEvent;
use SumoCoders\FrameworkCoreBundle\EventListener\DefaultMenuListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class MenuListener extends DefaultMenuListener implements EventSubscriberInterface
{
    public function onConfigureMenu(ConfigureMenuEvent $event): void
    {
        $factory = $event->getFactory();
        $menu = $event->getMenu();

        if ($this->getSecurity()->isGranted('ROLE_ADMIN')) {
            $menu->addChild(
                $factory->createItem(
                    $this->getTranslator()->trans('Users'),
                    [
                        'route' => 'user_admin_overview',
                        'labelAttributes' => [
                            'icon' => 'bi bi-person-fill',
                        ],
                        'extras' => [
                            'routes' => [
                                'user_admin_add',
                                'user_admin_edit',
                            ],
                        ],
                    ],
                )
            );
        }
    }

    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return [ConfigureMenuEvent::EVENT_NAME => 'onConfigureMenu'];
    }
}
