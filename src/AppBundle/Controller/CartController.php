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
        $repo = $this->get('es.manager.default.product');

        $products = [];

        $cart = json_decode($request->cookies->get('ongr_basket'), TRUE);

        if (isset($cart['items'])) {
            foreach ($cart['items'] as &$item) {
                /** @var Product $product */
                $item['product'] = $repo->find($item['id']);
                $item['url'] = isset($product) ? $product->url : '#';
            }
        }

        return $this->render(
            'inc/minicart.html.twig',
            [
                'products' => isset($cart['items']) ? $cart['items'] : [],
                'total' => isset($cart['amount']) ? $cart['amount'] : 0,
            ]
        );
    }
}
