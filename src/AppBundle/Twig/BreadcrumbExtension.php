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
use AppBundle\Document\Product;
use ONGR\ElasticsearchBundle\Service\Manager;
use ONGR\ElasticsearchDSL\Query\IdsQuery;
use ONGR\ElasticsearchDSL\Search;

class BreadcrumbExtension extends \Twig_Extension
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
            new \Twig_Function('breadcrumbs', [$this, 'getBreadcrumbs'])
        ];
    }

    /**
     * Returns array of breadcrumbs for given document.
     *
     * @param object $document
     *
     * @return array
     */
    public function getBreadcrumbs($document)
    {
        if ($document instanceof Category) {
            return $this->getCategoriesByPath($document->getPath());
        } elseif ($document instanceof Product) {
            return $this->getCategoriesByPath($document->getCategory()->getId());
        }

        throw new \InvalidArgumentException('Unsupported document type given.');
    }

    /**
     * @param string $path
     *
     * @return array
     */
    protected function getCategoriesByPath($path)
    {
        $nodeIds = array_filter(explode('/', $path));

        if (count($nodeIds) === 0) {
            return [];
        }

        $search = new Search();
        $search->addFilter(new IdsQuery(array_values($nodeIds)));
        $results = $this->manager->execute(['AppBundle:Category'], $search);

        $nodes = [];
        foreach ($results as $document) {
            $nodes[$document->getId()] = $document;
        }

        $sortedNodes = [];
        foreach ($nodeIds as $nodeId) {
            if (isset($nodes[$nodeId])) {
                $sortedNodes[] = $nodes[$nodeId];
            }
        }

        return $sortedNodes;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'breadcrumb';
    }
}
