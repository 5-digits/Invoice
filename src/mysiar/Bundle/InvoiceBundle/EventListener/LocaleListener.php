<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-11
 * Time: 13:01
 *
 * http://symfony.com/doc/2.8/session/locale_sticky_session.html
 *
 *
 * services.yml
        app.locale_listener:
            class: mysiar\Bundle\InvoiceBundle\EventListener\LocaleListener
            arguments: ['%kernel.default_locale%']
            tags:
                - { name: kernel.event_subscriber }
 *
 */

namespace mysiar\Bundle\InvoiceBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered after the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
        );
    }
}