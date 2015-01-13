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
     * Show product page by id.
     *
     * @param string $id Product id.
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function showAction($id)
    {
        try {
            $product = $this->get('es.manager')->getRepository('ONGRDemoBundle:Product')->find($id);
        } catch (Missing404Exception $e) {
            throw $this->createNotFoundException('Product was not found');
        }

        return $this->render(
            $this->getProductTemplate(),
            [
                'product' => $product,
            ]
        );
    }

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
            $this->getProductTemplate(),
            $this->documentActionData($document)
        );
    }

    /**
     * Returns template data for documentAction.
     *
     * @param Product $document
     *
     * @return array
     */
    private function documentActionData($document)
    {
        return [
            'product' => $document,
        ];
    }

    /**
     * Get main template for product.
     *
     * @return string
     */
    private function getProductTemplate()
    {
        return 'ONGRDemoBundle:Product:product.html.twig';
    }
}
