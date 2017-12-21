<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/19/2017
 * Time: 7:25 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Annotations\Annotation;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"product" = "Product", "sale" = "SaleItem", "normal" = "NormalItem"})
 *
 *
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="float")
     */
    protected $price;
    /**
     * @ORM\Column(type="string")
     */
    protected $image_path;
    /**
     * @ORM\OneToMany(targetEntity="OrderCartProduct", mappedBy="products", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderCartProduct[]
     */
    protected $cartProducts;
    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="products", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderProduct[]
     */
    protected $orderProducts;
    public $type = "product";
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->image_path = $imagePath;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->image_path;
    }
}