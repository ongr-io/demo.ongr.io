<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\Document;

use ONGR\ElasticsearchBundle\Annotation as ES;
use ONGR\ContentBundle\Document\AbstractCategoryDocument as Base;

/**
 * Stores category data.
 *
 * @ES\Document(type="category")
 */
class Category extends Base
{
    /**
     * @var string
     *
     * Overriding title field to change search analyzer.
     *
     * @ES\Property(name="title", type="string", searchAnalyzer="standard")
     */
    public $title;
}
