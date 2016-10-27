<?php
/**
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-27
 * Time: 12:44
 */

namespace mysiar\Bundle\InvoiceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use mysiar\Bundle\InvoiceBundle\Entity\Currency;


class LoadCurrencyData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $c1 = new Currency();
        $c1->setCurrencyCode('PLN');
        $c1->setCurrencyNum(985);
        $c1->setCurrencyExponent(2);

        $c2 = new Currency();
        $c2->setCurrencyCode('EUR');
        $c2->setCurrencyNum(978);
        $c2->setCurrencyExponent(2);

        $c3 = new Currency();
        $c3->setCurrencyCode('USD');
        $c3->setCurrencyNum(840);
        $c3->setCurrencyExponent(2);

        $c4 = new Currency();
        $c4->setCurrencyCode('GBP');
        $c4->setCurrencyNum(826);
        $c4->setCurrencyExponent(2);

        $c5 = new Currency();
        $c5->setCurrencyCode('CHF');
        $c5->setCurrencyNum(756);
        $c5->setCurrencyExponent(2);

        $c6 = new Currency();
        $c6->setCurrencyCode('CZK');
        $c6->setCurrencyNum(203);
        $c6->setCurrencyExponent(2);

        $c7 = new Currency();
        $c7->setCurrencyCode('CAD');
        $c7->setCurrencyNum(124);
        $c7->setCurrencyExponent(2);


        //EUR 978 2

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);
        $manager->persist($c4);
        $manager->persist($c5);
        $manager->persist($c6);
        $manager->persist($c7);
        $manager->flush();
    }
}