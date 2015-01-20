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
use ONGR\ContentBundle\Document\AbstractContentDocument;

/**
 * Holds content page data.
 *
 * @ES\Document(type="content")
 */
class Content extends AbstractContentDocument
{
    /**
     * @var string
     *
     * @ES\Property(name="slug", type="string", index="not_analyzed")
     */
    public $slug;

    /**
     * @var string
     *
     * @ES\Property(name="title", type="string", search_analyzer="standard")
     */
    public $title;

    /**
     * @var string
     *
     * @ES\Property(name="content", type="string")
     */
    public $content;
}
