<?php

namespace AppBundle\Document;

use ONGR\ElasticsearchBundle\Annotation as ES;
use ONGR\RouterBundle\Document\SeoAwareTrait;

/**
 * @ES\Document()
 */
class Product
{
    use SeoAwareTrait;

    /**
     * @ES\Id()
     */
    public $id;

    /**
     * @ES\Property(type="string")
     */
    public $title;

    /**
     * @ES\Property(type="string")
     */
    public $description;

    /**
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $brand;

    /**
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $color;

    /**
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $material;

    /**
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $images;

    /**
     * @ES\Property(type="float")
     */
    public $price;

    /**
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $categoryKeys;
}