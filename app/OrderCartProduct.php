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
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * @var Product
     */
    protected $product;
    /**
     * @ORM\ManyToOne(targetEntity="OrderCart", inversedBy="order_cart_products")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
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

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param OrderCart $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return OrderCart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }
}