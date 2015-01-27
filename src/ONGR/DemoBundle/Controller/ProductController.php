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

use Elasticsearch\Common\Exceptions\Missing404Exception;
use ONGR\DemoBundle\Document\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller for product page and list actions.
 */
class ProductController extends Controller
{
    /**
     * Render product document.
     *
     * @param Product $document
     *
     * @return Response
     */
    public function documentAction($document)
    {
        return $this->render(
            'ONGRDemoBundle:Product:product.html.twig',
            [
                'product' => $document,
            ]
        );
    }
}
