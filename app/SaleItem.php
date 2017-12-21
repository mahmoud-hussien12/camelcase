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
/**
 * @ORM\Entity
 * @ORM\Table(name="sale_items")
 */
class SaleItem extends Product
{
    /**
     * @ORM\Column(type="float")
     */
    protected $new_price;
    /**
     * @ORM\OneToMany(targetEntity="OrderCartProduct", mappedBy="sale_items", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderCartProduct[]
     */
    protected $carts;
    public $type = "sale";
    /**
     * @return mixed
     */
    public function getNewPrice()
    {
        return $this->new_price;
    }

    /**
     * @param mixed $new_price
     */
    public function setNewPrice($new_price)
    {
        $this->new_price = $new_price;
    }
}