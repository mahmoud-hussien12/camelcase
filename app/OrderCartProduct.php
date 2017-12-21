<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/20/2017
 * Time: 7:32 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="order_cart_products")
 */
class OrderCartProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="order_cart_products")
     * @var Product
     */
    protected $product;
    /**
     * @ORM\ManyToOne(targetEntity="OrderCart", inversedBy="order_cart_products")
     * @var OrderCart
     */
    protected $cart;
    /**
     * @ORM\Column(type="integer")
     */
    public $unit;
    function __construct(OrderCart $cart, Product $product, $unit)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->unit = $unit;
    }
    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}