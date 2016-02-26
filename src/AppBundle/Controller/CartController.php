<?php

namespace AppBundle\Controller;

use AppBundle\Document\Category;
use AppBundle\Document\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    /**
     * Product list for single category.
     */
    public function miniCartAction(Request $request)
    {
        $products = [];

        return $this->render(
            'inc/minicart.html.twig',
            [
                'products' => $products,
                'total' => 0,
            ]
        );
    }
}
