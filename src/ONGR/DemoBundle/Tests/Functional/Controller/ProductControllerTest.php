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

class ProductControllerTest extends WebTestCase
{
    /**
     * Tests if product page is being loaded.
     */
    public function testProductAction()
    {
        $client = static::createClient();
        $client->request('GET', '/europe/-Marqu-s-De-Castilla-Blanco-2013.html');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
