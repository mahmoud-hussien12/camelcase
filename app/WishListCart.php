<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/19/2017
 * Time: 7:29 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="wish_carts")
 */
class WishListCart extends Cart
{
    /**
     * @var \Doctrine\Common\Collections\Collection|Product[]
     *
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="wish_carts")
     * @ORM\JoinTable(
     *  name="wish_products",
     *  joinColumns={
     *      @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $products;
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="wish_carts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $user;
    function __construct()
    {
        $this->products = new ArrayCollection;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return Product[]|\Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
    public function addProduct(Product $product)
    {
        if(!$this->products->contains($product)) {
            $this->products->add($product);
        }
    }
    public function removeProduct(Product $product){
        if($this->products->contains($product)) {
            $index = $this->products->indexOf($product);
            $this->products->remove($index);
        }
    }
    public function emptyProducts(){
        $this->products = new ArrayCollection;
    }
}