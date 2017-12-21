<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/19/2017
 * Time: 7:27 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Annotations\Annotation;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
/**
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"cart" = "Cart", "wish" = "WishListCart", "order" = "OrderCart"})
 *
 *
 */

abstract class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    abstract public function addProduct(Product $product);

}