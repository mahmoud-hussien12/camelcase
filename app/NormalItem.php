<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 12/19/2017
 * Time: 7:26 PM
 */

namespace App;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="normal_items")
 */
class NormalItem extends Product
{
    /**
     * @ORM\OneToMany(targetEntity="OrderCartProduct", mappedBy="normal_items", cascade={"persist"})
     * @var \Doctrine\Common\Collections\Collection|OrderCartProduct[]
     */
    protected $carts;
    public $type = "normal";
}