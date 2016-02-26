<?php

namespace AppBundle\Controller;

use AppBundle\Document\Category;
use AppBundle\Document\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * Product list for single category.
     */
    public function listAction(Request $request, Category $document)
    {
        $filterManager = $this->get('ongr_filter_manager.product_list')->handleRequest($request);

        return $this->render(
            'product/list.html.twig',
            [
                'category' => $document,
                'filter_manager' => $filterManager,
            ]
        );
    }

    public function showAction(Product $document)
    {
        return $this->render(
            'product/show.html.twig',
            [
                'product' => $document,
                'shop_url_origin' => $this->getParameter('shop_url_origin'),
            ]
        );
    }
}
