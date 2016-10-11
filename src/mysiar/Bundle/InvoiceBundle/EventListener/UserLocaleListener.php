<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-11
 * Time: 13:11
 *
 * http://symfony.com/doc/2.8/session/locale_sticky_session.html

app.user_locale_listener:
            class: AppBundle\EventListener\UserLocaleListener
            arguments: ['@session']
            tags:
                - { name: kernel.event_listener, event: security.interactive_login, method: onInteractiveLogin }

 */
namespace mysiar\Bundle\InvoiceBundle\EventListener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Stores the locale of the user in the session after the
 * login. This can be used by the LocaleListener afterwards.
 */
class UserLocaleListener
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if (null !== $user->getLocale()) {
            $this->session->set('_locale', $user->getLocale());
        }
    }
}