<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/20/2017
 * Time: 11:30 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Support\Facades\DB;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="float")
     */
    protected $total_price;
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $user;
    /**
     * @param mixed $total_price
     */
    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="orders", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderProduct[]
     */
    protected $orderProducts;
    function __construct()
    {
        $this->orderProducts = new ArrayCollection;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
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
     * @return OrderProduct[]|\Doctrine\Common\Collections\Collection
     */
    public function getOrderProducts()
    {
        $result  = DB::select("SELECT * FROM `order_products` WHERE order_id=?", [$this->id]);
        return $result;
        //return $this->orderProducts;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    public function addProduct(Product $product){
        $noChange = true;
        foreach ($this->orderProducts as $p){
            if($p->getProduct()->getId() == $product->getId()){
                $p->unit += 1;
                $noChange = false;
                break;
            }
        }
        if($noChange){
            $this->orderProducts->add(new OrderProduct($this, $product, 1));
        }
    }
}