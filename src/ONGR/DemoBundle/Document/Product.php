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
use ONGR\ElasticsearchBundle\Document\DocumentInterface;
use ONGR\ElasticsearchBundle\Document\DocumentTrait;
use ONGR\RouterBundle\Document\SeoAwareTrait;

/**
 * Product document.
 *
 * @ES\Document
 */
class Product implements DocumentInterface
{
    use DocumentTrait;
    use SeoAwareTrait;

    /**
     * @var string
     *
     * @ES\Property(name="sku", type="string", index="not_analyzed")
     */
    public $sku;

    /**
     * @var string
     *
     * @ES\Property(name="title", type="string", search_analyzer="standard")
     */
    public $title;

    /**
     * @var string
     *
     * @ES\Property(
     *      name="title_suggest",
     *      type="completion",
     *      index_analyzer="simple",
     *      search_analyzer="simple",
     *      payloads=true
     * )
     */
    public $titleSuggest;

    /**
     * @var string
     *
     * @ES\Property(name="description", type="string")
     */
    public $description;

    /**
     * @var float
     *
     * @ES\Property(name="price", type="float")
     */
    public $price;

    /**
     * @var int
     *
     * @ES\Property(name="total_rating", type="integer")
     */
    public $totalRating;

    /**
     * @var string
     *
     * @ES\Property(name="location", type="geo_point")
     */
    public $location;

    /**
     * Image URL.
     *
     * @var string
     *
     * @ES\Property(name="image", type="string")
     */
    public $image;

    /**
     * @var string
     *
     * @ES\Property(name="thumb", type="string", index="no")
     */
    public $thumb;

    /**
     * @var string
     *
     * @ES\Property(name="icon", type="string", index="no")
     */
    public $icon;

    /**
     * @var string
     *
     * @ES\Property(name="category", type="string", index_analyzer="pathAnalyzer")
     */
    public $category;

    /**
     * @var string
     *
     * @ES\Property(name="category_title", type="string", index_analyzer="pathAnalyzer")
     */
    public $categoryTitle;

    /**
     * @var string
     *
     * @ES\Property(name="category_id", type="string", index="not_analyzed")
     */
    public $categoryId;

    /**
     * @var string
     *
     * @ES\Property(name="main_category", type="string", index="not_analyzed")
     */
    public $mainCategory;

    /**
     * @var string
     *
     * @ES\Property(name="attributes", type="string", index="no")
     */
    public $attributes;

    /**
     * @var string
     *
     * @ES\Property(name="manufacturer", type="string", index="not_analyzed")
     */
    public $manufacturer;

    /**
     * @var string
     *
     * @ES\Property(name="long_description", type="string", index="no")
     */
    public $longDescription;

    /**
     * @var ProductReview
     *
     * @ES\Property(name="reviews", type="object", objectName="ONGRDemoBundle:ProductReview")
     */
    public $reviews;

    /**
     * @var ProductOrigin
     *
     * @ES\Property(name="origin", type="object", objectName="ONGRDemoBundle:ProductOrigin")
     */
    public $origin;

    /**
     * @var string
     *
     * @ES\Property(name="grape", type="string", index="not_analyzed")
     */
    public $grape;

    /**
     * @var float
     *
     * @ES\Property(name="alcohol_level", type="float")
     */
    public $alcoholLevel;

    /**
     * @var string
     *
     * @ES\Property(name="wine_style", type="string", index="not_analyzed")
     */
    public $wineStyle;

    /**
     * @var string
     *
     * @ES\Property(name="wine_colour", type="string", index="not_analyzed")
     */
    public $wineColour;

    /**
     * Returns selected category id by specified path.
     *
     * @param string $path
     *
     * @return null|string
     */
    public function getSelectedCategory($path)
    {
        $path = ltrim($path, '/');

        foreach ($this->url as $url) {
            if ($url->url === $path) {
                return $url->url;
            }
        }

        return null;
    }
}
