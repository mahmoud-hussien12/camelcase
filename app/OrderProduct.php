<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/20/2017
 * Time: 11:35 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="order_products")
 */

class OrderProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="order_products")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * @var Product
     */
    protected $product;
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="order_products")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * @var Order
     */
    protected $order;
    /**
     * @ORM\Column(type="integer")
     */
    public $unit;
    function __construct(Order $order, Product $product, $unit)
    {
        $this->order = $order;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}