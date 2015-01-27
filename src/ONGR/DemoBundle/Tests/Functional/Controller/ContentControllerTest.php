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
     * Returns existing urls of pages.
     *
     * @return array
     */
    public function existingPagesUrlsDataProvider()
    {
        return [
            ['/'],
            ['/about/'],
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
     * Tests not existing urls.
     */
    public function testNotExistingUrls()
    {
        $client = static::createClient();

        $client->request('GET', '/doesntexists/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        // Elasticsearch returns Missing404Exception exception, but Symfony converts it to 500 error.
        // The source can be found here: https://github.com/symfony/HttpKernel/blob/2.6/HttpKernel.php#L247 .
        $client->request('GET', '/category/r4nd0m1d');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/product/r4nd0m1d');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
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
            $crawler->filter('html:contains("ONGR")')->count(),
            'Should be a word "ONGR" in html content'
        );
    }
}
