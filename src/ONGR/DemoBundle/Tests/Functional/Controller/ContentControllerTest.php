<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentControllerTest extends WebTestCase
{
    /**
     * Tests if homepage is loading without errors.
     */
    public function testHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("demo")')->count(),
            'Should be a word "demo" in html content'
        );
    }

    /**
     * Tests if existing page is loading without errors.
     */
    public function testExistingPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("about")')->count(),
            'Should be a word "demo" in html content'
        );

        $this->assertEquals(
            'About',
            $crawler->filter('ol.breadcrumb > li.active')->text()
        );

        $crawler = $client->request('GET', '/page/about/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("about")')->count(),
            'Should be a word "demo" in html content'
        );

        $this->assertEquals(
            'About',
            $crawler->filter('ol.breadcrumb > li.active')->text()
        );
    }

    /**
     * Tests not existing page.
     */
    public function testNotExistingPage()
    {
        $client = static::createClient();

        $client->request('GET', '/doesntexists/');
        $this->assertTrue($client->getResponse()->isNotFound(), 'Should throw NotFoundHttpException');

        $client->request('GET', '/page/doesntexists/');
        $this->assertTrue($client->getResponse()->isNotFound(), 'Should throw NotFoundHttpException');
    }
}
