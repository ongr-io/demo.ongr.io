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

class CategoryControllerTest extends WebTestCase
{
    /**
     * Tests document action.
     */
    public function testDocumentAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/europe/');

        $this->assertEquals(
            2,
            $crawler->filter('div.col-sm-9 > ol.breadcrumb')->children()->count(),
            'Should be two elements in breadcrumb trail.'
        );

        // Main navbar should have categories.
        $this->assertEquals(
            1,
            $crawler->filter(
                'nav.navbar.navbar-default > div.collapse.navbar-collapse > ul.nav.navbar-nav:contains("Europe")'
            )->count()
        );

        // Sidebar should have categories as well.
        $this->assertEquals(
            1,
            $crawler->filter('ul.sidebar-category > ul:contains("Europe")')->count()
        );
    }

    /**
     * Tests getting of category template.
     *
     * A request of ajax changes a behaviour of method - it must return
     * ONGRDemoBundle:Product:list.html.twig template, otherwise -
     * ONGRDemoBundle:Category:category.html.twig.
     */
    public function testGetCategoryTemplate()
    {
        $client = static::createClient();

        // Prepare ajax request.
        $crawler = $client->request(
            'GET',
            '/europe/',
            [],
            [],
            [
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            ]
        );

        // ONGRDemoBundle:Category:category.html.twig template has sidebar block and extends
        // ONGRDemoBundle:Product:list.html.twig template. We assume that there is no sidebar.
        $this->assertEquals(0, $crawler->filter('ul.nav.nav-pills.nav-stacked.sidebar-category')->count());
    }
}
