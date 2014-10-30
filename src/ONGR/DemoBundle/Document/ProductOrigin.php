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
 * Product location data.
 *
 * @ES\Object()
 */
class ProductOrigin
{
    /**
     * @var string
     *
     * @ES\Property(name="country", type="string", index="not_analyzed")
     */
    public $country;

    /**
     * @var string
     *
     * @ES\Property(name="location", type="string", index="not_analyzed")
     */
    public $location;
}
