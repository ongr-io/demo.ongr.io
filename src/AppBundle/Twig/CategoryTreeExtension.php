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
use ONGR\ElasticsearchBundle\Service\Manager;

class CategoryTreeExtension extends \Twig_Extension
{
    /**
     * @var Manager
     */
    private $manager;

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
        $categories = $repository->findBy([]);

        return $this->buildTree($categories);
    }

    protected function buildTree($categories)
    {
        $tree = [];

        /** @var Category $category */
        foreach ($categories as $category) {
            $this->addCategory($tree, trim($category->getPath(), '/'), $category);
        }

        return $tree;
    }

    private function addCategory(&$tree, $path, Category $category)
    {
        $path = explode('/', $path, 2);

        if (!isset($path[1])) {
            $tree[$category->getId()]['document'] = $category;
        } else {
            if (!isset($tree[$path[0]]['children'])) {
                $tree[$path[0]]['children'] = [];
            }

            $this->addCategory($tree[$path[0]]['children'], $path[1], $category);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'category_tree';
    }
}
