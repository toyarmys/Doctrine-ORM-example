<?php
// src/Bug.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="bugs")
 */
class Bug
{
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignedBugs")
     */
    protected $engineer;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     */
    protected $reporter;

    /**
     * @ORM\ManyToMany(targetEntity="Product")
     */
    protected $products;

    public function __construct(){
        $this->products = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getEngineer(){
        return $this->engineer;
    }

    public function setEngineer($engineer){
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function getReport(){
        return $this->reporter;
    }

    public function setReport($reporter){
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function getCreated(){
        return $this->created;
    }

    public function setCreated(DateTime $created){
        $this->created = $created;
    }

    public function getProduct(){
        return $this->products;
    }

    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    public function close()
    {
        $this->status = "CLOSE";
    }
}