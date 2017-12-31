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
use App\Cart;

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
     * @ORM\OneToMany(targetEntity="OrderCartProduct", mappedBy="order_carts", cascade={"persist", "detach"})
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
     * @return OrderCartProduct[]|\Doctrine\Common\Collections\Collection
     */
    public function getOrderCartProducts(){

        EntityManager::getRepository('App\Product')->findAll();
        $array = EntityManager::getRepository('App\OrderCartProduct')->findBy(array('cart'=>$this->id));
        $this->orderCartProducts = new ArrayCollection;
        foreach ($array as $orderCartProduct){
            $this->orderCartProducts->add($orderCartProduct);
        }

        return $this->orderCartProducts;
    }

    public function addProduct(Product $product){

        if($this->orderCartProducts->isEmpty()){//if array is empty
            $orderCartProduct = new OrderCartProduct($this, $product, 1);
            $this->orderCartProducts->add($orderCartProduct);
        }else{//if product already exist increment unit
            $noChange = true;
            $index = 0;
            foreach ($this->orderCartProducts as $p){
                if($p->getProduct()->getId() == $product->getId()){
                    $this->orderCartProducts[$index]->unit += 1;
                    $noChange = false;
                    break;
                }
                $index++;
            }
            if($noChange){//if product is not exist
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
    public function emptyProducts(){
        $this->orderCartProducts = new ArrayCollection;
        $this->total_price = 0.0;
        EntityManager::merge($this);
        foreach ($this->getOrderCartProducts() as $orderCartProduct){
            EntityManager::remove($orderCartProduct);
        }
        EntityManager::flush();
    }
}