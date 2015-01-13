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
     * Returns not existing urls.
     *
     * @return array
     */
    public function notExistingUrlsDataProvider()
    {
        return [
            ['/doesntexists/'],
            ['/page/doesntexists/'],
            ['/category/r4nd0m1d'],
            ['/product/r4nd0m1d'],
        ];
    }

    /**
     * Returns existing urls of pages.
     *
     * @return array
     */
    public function existingPagesUrlsDataProvider()
    {
        return [
            ['/about/'],
            ['/page/about/'],
        ];
    }

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
     * Tests not existing url.
     *
     * @param string $url
     *
     * @dataProvider notExistingUrlsDataProvider()
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNotExistingUrl($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
    }

    /**
     * Tests if existing page is loading without errors.
     *
     * @param string $url
     *
     * @dataProvider existingPagesUrlsDataProvider()
     */
    public function testExistingPage($url)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

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
}
