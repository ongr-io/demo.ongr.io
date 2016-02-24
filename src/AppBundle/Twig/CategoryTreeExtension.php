<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

use AppBundle\Document\Category;
use ONGR\ElasticsearchBundle\Result\Result;
use ONGR\ElasticsearchBundle\Service\Manager;
use ONGR\ElasticsearchDSL\Query\IdsQuery;
use ONGR\ElasticsearchDSL\Query\MatchAllQuery;
use ONGR\ElasticsearchDSL\Query\TermQuery;
use ONGR\ElasticsearchDSL\Query\TermsQuery;
use ONGR\ElasticsearchDSL\Search;
use ONGR\ElasticsearchDSL\Sort\FieldSort;

class CategoryTreeExtension extends \Twig_Extension
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * Category tree root categories id list.
     *
     * @var array
     */
    private $rootCategories = [];

    /**
     * Constructor.
     *
     * @param $manager
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function getRootCategories()
    {
        return $this->rootCategories;
    }

    /**
     * @param array $rootCategories
     */
    public function setRootCategories($rootCategories)
    {
        $this->rootCategories = $rootCategories;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('category_tree', [$this, 'getCategoryTree'])
        ];
    }

    /**
     * Returns pre-built category tree.
     *
     * Output example:
     *
     *     [
     *         'abc' => [
     *             'document' => (object) Category,
     *         ],
     *         'def' => [
     *             'document' => (object) Category,
     *             'children' => [
     *                 'ghj' => [
     *                     'document' => (object) Category,
     *                 ],
     *             ],
     *         ],
     *     ]
     *
     * @return array
     */
    public function getCategoryTree()
    {
        $repository = $this->manager->getRepository('AppBundle:Category');

        /** @var Search $search */
        $search = $repository->createSearch();
        $search->addQuery(new IdsQuery($this->getRootCategories()));
        $search->addSort(new FieldSort('sort_key', FieldSort::DESC));
        $search->setSize(1000);

        $categories = $repository->execute($search);

        $tree = [];
        /** @var Category $category */
        foreach ($categories as $category) {
            $tree[$category->key]['document'] = $category;
            $tree[$category->key]['children'] = $this->getChildrens($category);
        }

        return $tree;
    }

    /**
     * @param Category $document
     *
     * @return array
     */
    private function getChildrens($document)
    {
        $repository = $this->manager->getRepository('AppBundle:Category');

        /** @var Search $search */
        $search = $repository->createSearch();
        $search->addQuery(new TermQuery('parentKey', $document->id));
        $search->setSize(1000);

        $categories = $repository->execute($search);

        $tree = [];
        /** @var Category $category */
        foreach ($categories as $category) {
            $tree[$category->key]['document'] = $category;
//            $tree[$category->key]['children'] = $this->getChildrens($category);
        }

        return $tree;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'category_tree';
    }
}
