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
     * Tests document action
     */
    public function testDocumentAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/europe/');
        $crawler = $crawler->filter('div.col-sm-9 > ol.breadcrumb');

        $this->assertEquals(2, $crawler->children()->count(), 'Should be two elements in breadcrumb trail.');
    }
}
