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

use AppBundle\Document\Product\Category as ProductCategory;
use AppBundle\Document\Product\Origin;
use ONGR\ElasticsearchBundle\Annotation as ES;

/**
 * @ES\Document()
 */
class Product
{
    /**
     * @var string
     *
     * @ES\Id()
     */
    private $id;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    private $description;

    /**
     * @var ProductCategory
     *
     * @ES\Embedded(class="AppBundle:Product\Category")
     */
    private $category;

    /**
     * @var Origin
     *
     * @ES\Embedded(class="AppBundle:Product\Origin")
     */
    private $origin;

    /**
     * @var float
     *
     * @ES\Property(type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    private $image;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    private $thumb;

    /**
     * @var int
     *
     * @ES\Property(type="integer")
     */
    private $rating;

    /**
     * @var string
     *
     * @ES\Property(type="string")
     */
    private $grape;

    /**
     * @var float
     *
     * @ES\Property(type="float")
     */
    private $alcoholLevel;

    /**
     * @var string
     *
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    private $wineStyle;

    /**
     * @var string
     *
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    private $wineColour;

    /**
     * @var string
     *
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ES\Property(type="string", options={"index"="not_analyzed"})
     */
    public $url;
//    private $url;

    /**
     * @param string $id
     *
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param ProductCategory $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return ProductCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Origin $origin
     *
     * @return Product
     */
    public function setOrigin(Origin $origin = null)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return Origin
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $url
     *
     * @return Product
     */
    public function setImage($url)
    {
        $this->image = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $url
     *
     * @return Product
     */
    public function setThumb($url)
    {
        $this->thumb = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param int $rating
     *
     * @return Product
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $grape
     *
     * @return Product
     */
    public function setGrape($grape)
    {
        $this->grape = $grape;

        return $this;
    }

    /**
     * @return string
     */
    public function getGrape()
    {
        return $this->grape;
    }

    /**
     * @param float $level
     *
     * @return Product
     */
    public function setAlcoholLevel($level)
    {
        $this->alcoholLevel = $level;

        return $this;
    }

    /**
     * @return float
     */
    public function getAlcoholLevel()
    {
        return $this->alcoholLevel;
    }

    /**
     * @param string $style
     *
     * @return Product
     */
    public function setWineStyle($style)
    {
        $this->wineStyle = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getWineStyle()
    {
        return $this->wineStyle;
    }

    /**
     * @param string $color
     *
     * @return Product
     */
    public function setWineColour($color)
    {
        $this->wineColour = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getWineColour()
    {
        return $this->wineColour;
    }

    /**
     * @param string $manufacturer
     *
     * @return Product
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param string $url
     *
     * @return Product
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
