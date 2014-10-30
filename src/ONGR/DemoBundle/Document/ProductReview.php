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

/**
 * Product review data.
 *
 * @ES\Object()
 */
class ProductReview
{
    /**
     * @var string
     *
     * @ES\Property(name="name", type="string")
     */
    public $name;

    /**
     * @var string
     *
     * @ES\Property(name="review", type="string")
     */
    public $review;

    /**
     * @var int
     *
     * @ES\Property(name="rating", type="integer")
     */
    public $rating;

    /**
     * @var string
     *
     * @ES\Property(name="created_at", type="string")
     */
    public $createdAt;
}
