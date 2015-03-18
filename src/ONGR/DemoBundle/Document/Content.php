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
use ONGR\ContentBundle\Document\AbstractContentDocument as Base;

/**
 * Holds content page data.
 *
 * @ES\Document(type="content")
 */
class Content extends Base
{
    // Put here type modifications if needed.
}
