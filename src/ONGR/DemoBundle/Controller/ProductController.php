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
     * Product page action.
     *
     * @param string $productId
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function productAction($productId)
    {
        $product = $this->get('es.manager')->getRepository('product')->find($productId);

        if ($productId === null) {
            throw $this->createNotFoundException();
        }

        return $this->render(
            $this->getProductTemplate($product),
            [
                'product' => $product
            ]
        );
    }

    /**
     * Render product document.
     *
     * @param Request $request
     * @param Product $document
     *
     * @return Response
     */
    public function documentAction(Request $request, $document)
    {
        return $this->render(
            $this->getProductTemplate(),
            $this->documentActionData($request, $document)
        );
    }

    /**
     * Returns template data for documentAction.
     *
     * @param Request $request
     * @param Product $document
     *
     * @return array
     */
    private function documentActionData(Request $request, $document)
    {
        $currentPath = $request->getPathInfo();

        return [
            'product' => $document,
            'selectedCategory' => $document->getSelectedCategory($currentPath),
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
