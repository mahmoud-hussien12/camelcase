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
use \Doctrine\Common\Annotations\Annotation;
use Illuminate\Support\Facades\DB;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_carts")
 */

class OrderCart extends Cart
{
    /**
     * @ORM\Column(type="float")
     */
    protected $total_price;
    /**
     * @ORM\OneToMany(targetEntity="OrderCartProduct", mappedBy="order_carts", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderCartProduct[]
     */
    protected $orderCartProducts;
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="order_carts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $user;
    function __construct()
    {
        $this->orderCartProducts = new ArrayCollection;
        $this->total_price = 0.0;
    }

    /**
     * @param mixed $total_price
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
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
     * @return OrderCartProduct[]|ArrayCollection
     */
    public function getOrderCartProducts()
    {
        $result  = DB::select("SELECT * FROM `order_cart_products` WHERE `cart_id`=?", [$this->id]);
        return $result;
        //return $this->orderCartProducts;
    }
    public function getProductArr(){
        return $this->orderCartProducts;
    }
    public function setOrderCartProducts(){
        $this->orderCartProducts = new ArrayCollection;
        $res = $this->getOrderCartProducts();
        $product = new Product();
        foreach ($res as $p){
            $product = EntityManager::find('App\Product', $p->product_id);
            $this->orderCartProducts->add(new OrderCartProduct($this, $product, $p->unit));
        }
        return $this->orderCartProducts;
    }
    public function addProduct(Product $product){
        if(count($this->orderCartProducts) <= 0){
            $this->orderCartProducts->add(new OrderCartProduct($this, $product, 1));
        }else{
            $noChange = true;
            $index = 0;
            foreach ($this->orderCartProducts as $p){
                if($p->getProduct()->getId() == $product->getId()){
                    //$p->unit += 1;
                    $this->orderCartProducts[$index]->unit += 1;
                    $noChange = false;
                    break;
                }
                $index++;
            }
            if($noChange){
                $this->orderCartProducts->add(new OrderCartProduct($this, $product, 1));
            }
        }
    }
    public function removeProduct(Product $product){
        $i = 0;
        foreach ($this->orderCartProducts as $p){
            if($p->getProduct()->getId() == $product->getId()){
                $p->unit -= 1;
                if($p->unit <= 0){
                    $this->orderCartProducts->remove($i);
                }
                break;
            }
            $i++;
        }
    }
}