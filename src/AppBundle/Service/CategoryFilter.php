<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use AppBundle\Document\Category;
use ONGR\ElasticsearchBundle\Result\DocumentIterator;
use ONGR\ElasticsearchDSL\Query\TermsQuery;
use ONGR\ElasticsearchDSL\Search;
use ONGR\FilterManagerBundle\Filter\FilterState;
use ONGR\FilterManagerBundle\Filter\ViewData;
use ONGR\FilterManagerBundle\Filter\Widget\AbstractSingleRequestValueFilter;
use ONGR\FilterManagerBundle\Search\SearchRequest;
use Symfony\Component\HttpFoundation\Request;

class CategoryFilter extends AbstractSingleRequestValueFilter
{
    /**
     * {@inheritdoc}
     */
    public function getViewData(DocumentIterator $result, ViewData $data)
    {
        if ($data->getState()->isActive()) {
            $urlParameters = $data->getUrlParameters();
            $urlParameters['document'] = $data->getState()->getValue();
            $data->setUrlParameters($urlParameters);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function preProcessSearch(Search $search, Search $relatedSearch, FilterState $state = null)
    {
        // Nothing more to do here.
    }

    /**
     * {@inheritdoc}
     */
    public function modifySearch(Search $search, FilterState $state = null, SearchRequest $request = null)
    {
        if ($state && $state->isActive()) {
            $search->addFilter(new TermsQuery('categoryKeys', [$state->getValue()->id]));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getState(Request $request)
    {
        $state = parent::getState($request);

        $value = $this->extractDocumentValue($request);

        if ($value !== null) {
            $state->setValue($value);
            $state->setActive(true);
        }

        return $state;
    }

    /**
     * @return string
     */
    public function getRequestField()
    {
        // Router bundle specific name
        return 'document';
    }

    /**
     * @param string $requestField
     */
    public function setRequestField($requestField)
    {
        throw new \LogicException('You can not set custom request field for this filter.');
    }

    /**
     * Extracts document value.
     *
     * @param Request $request
     *
     * @return Category|null
     */
    protected function extractDocumentValue(Request $request)
    {
        $document = $request->get($this->getRequestField());

        if (!$document instanceof Category) {
            return null;
        }

        return $document;
    }
}
