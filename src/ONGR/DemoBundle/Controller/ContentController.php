<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\Controller;

use ONGR\ElasticsearchBundle\Document\DocumentInterface;
use ONGR\ContentBundle\Service\ContentService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Manages content for home and info pages.
 */
class ContentController extends Controller
{
    /**
     * App index page controller.
     *
     * @return Response
     */
    public function homePageAction()
    {
        return $this->render(
            'ONGRDemoBundle::home.html.twig',
            []
        );
    }

    /**
     * Renders a document.
     *
     * @param DocumentInterface $document
     *
     * @return Response
     */
    public function documentAction($document)
    {
        return $this->render(
            'ONGRDemoBundle:Content:page.html.twig',
            [
                'content' => $document,
            ]
        );
    }
}
