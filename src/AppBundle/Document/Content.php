<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Document;

use ONGR\ElasticsearchBundle\Annotation as ES;
use ONGR\RouterBundle\Document\SeoAwareTrait;

/**
 * @ES\Document()
 */
class Content
{
    use SeoAwareTrait;

    /**
     * @var string
     *
     * @ES\Id()
     */
    public $id;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    public $slug;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    public $title;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    public $content;
}
