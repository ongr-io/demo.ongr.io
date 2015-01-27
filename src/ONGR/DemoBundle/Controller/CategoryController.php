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
use ONGR\ElasticsearchBundle\Document\DocumentInterface;
use ONGR\ContentBundle\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller for category pages.
 */
class CategoryController extends Controller
{
    /**
     * Show category page with passed document object from router.
     *
     * @param Request           $request
     * @param DocumentInterface $document
     *
     * @return Response
     */
    public function documentAction(Request $request, $document)
    {
        $productList = $this->get('ongr_filter_manager.product_list')->execute($request);

        return $this->render(
            $this->getCategoryTemplate($request),
            [
                'filter_manager' => $productList,
                'category' => $document,
            ]
        );
    }

    /**
     * Category tree action.
     *
     * @param string $theme
     * @param int    $maxLevel
     * @param string $partialTree
     * @param string $selectedCategory
     *
     * @return Response
     */
    public function categoryTreeAction($theme, $maxLevel, $partialTree, $selectedCategory)
    {
        return $this->render(
            'ONGRDemoBundle:Category:tree.html.twig',
            [
                'theme' => $this->getCategoryTreeTemplate($theme),
                'max_level' => $maxLevel,
                'selected_category' => $selectedCategory,
                'from_category' => $partialTree == 'pt' ? null : $partialTree,
            ]
        );
    }

    /**
     * Returns category page template name.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function getCategoryTemplate(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return 'ONGRDemoBundle:Product:list.html.twig';
        }

        return 'ONGRDemoBundle:Category:category.html.twig';
    }

    /**
     * Returns category tree template name.
     *
     * @param string $theme
     *
     * @return string
     */
    protected function getCategoryTreeTemplate($theme)
    {
        switch ($theme) {
            case 'top':
                return 'ONGRDemoBundle:Category:inc/topmenu.html.twig';
            case 'breadcrumbs':
                return 'ONGRDemoBundle:Category:breadcrumbs.html.twig';
            case 'product_breadcrumbs':
                return 'ONGRDemoBundle:Product:breadcrumbs.html.twig';
            default:
                return 'ONGRDemoBundle:Category:inc/categorytree.html.twig';
        }
    }
}
