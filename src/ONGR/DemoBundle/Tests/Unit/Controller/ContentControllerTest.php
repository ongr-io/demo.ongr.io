<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\Tests\Unit\Controller;

use ONGR\DemoBundle\Controller\ContentController;
use Symfony\Component\DependencyInjection\Container;

class ContentControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests a case when getDocumentBySlug() method returns null.
     *
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testPageAction()
    {
        $contentServiceMock = $this->getMockBuilder('ONGR\ContentBundle\Service\ContentService')
            ->disableOriginalConstructor()
            ->getMock();

        $contentServiceMock->expects($this->once())
            ->method('getDocumentBySlug')
            ->will($this->returnValue(null));

        $container = new Container();
        $container->set('ongr_content.content_service', $contentServiceMock);

        $controller = new ContentController();
        $controller->setContainer($container);
        $controller->pageAction('Europe');
    }
}
