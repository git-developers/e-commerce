<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Product
 */
class Product
{
	
	const ROLE_PRODUCT_VIEW = 'ROLE_PRODUCT_VIEW';
	const ROLE_PRODUCT_CREATE = 'ROLE_PRODUCT_CREATE';
	const ROLE_PRODUCT_EDIT = 'ROLE_PRODUCT_EDIT';
	const ROLE_PRODUCT_DELETE = 'ROLE_PRODUCT_DELETE';
	
    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "frontend",
     *     "ticket"
     * })
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "ticket"
     * })
     */
    private $color;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "frontend",
	 *     "ticket"
	 * })
	 */
	private $price;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "frontend",
     *     "ticket"
     * })
     */
    private $name;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "frontend",
     *     "ticket"
     * })
     */
    private $descriptionShort;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "frontend",
     *     "ticket"
     * })
     */
    private $descriptionLong;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "frontend",
     * })
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "frontend",
     * })
     */
    private $model;

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "ticket"
     * })
     */
    private $stock;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({
     *     "crud",
     *     "ticket"
     * })
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $userCreate;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $userUpdate;

    /**
     * @var boolean
     */
    private $isActive = true;

    /**
     * @var boolean
     *
     * @JMSS\Groups({
     *     "crud"
     * })
     */
    private $isFeatured = false;

    /**
     * @var \Bundle\CategoryBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Bundle\CategoryBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({
     *     "ticket"
     * })
     */
    private $category;

    /**
     * @var \Bundle\ProductBundle\Entity\Brand
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Brand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({
     *     "frontend"
     * })
     */
    private $brand;
	
	/**
	 * @var \Bundle\ProductBundle\Entity\Unit
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Unit")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $unit;
	
	/**
	 * @var integer
	 *
	 * @JMSS\Groups({
	 *     "ticket"
	 * })
	 */
	private $quantity;
	
	/**
	 * @var array
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "frontend",
	 *     "ticket"
	 * })
	 */
	private $files;
	
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
	
	/**
	 * @return string
	 */
	public function getColor()//: string
	{
		return $this->color;
	}
	
	/**
	 * @param string $color
	 */
	public function setColor(string $color)
	{
		$this->color = $color;
	}
	
	/**
	 * @return float
	 */
	public function getPrice() //: float
	{
		return $this->price;
	}
	
	/**
	 * @param float $price
	 */
	public function setPrice(float $price)
	{
		$this->price = $price;
	}
	
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Product
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return integer
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Product
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set category
     *
     * @param \Bundle\CategoryBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\Bundle\CategoryBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Bundle\CategoryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
	
	/**
	 * Set unit
	 *
	 * @param \Bundle\ProductBundle\Entity\Unit $unit
	 *
	 * @return Product
	 */
	public function setUnit(\Bundle\ProductBundle\Entity\Unit $unit = null)
	{
		$this->unit = $unit;
		
		return $this;
	}
	
	/**
	 * Get unit
	 *
	 * @return \Bundle\ProductBundle\Entity\Unit
	 */
	public function getUnit()
	{
		return $this->unit;
	}
	
	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}
	
	/**
	 * @param int $quantity
	 */
	public function setQuantity(int $quantity)
	{
		$this->quantity = $quantity;
	}
	
	/**
	 * @return array
	 */
	public function getFiles()//: array
	{
		return $this->files;
	}
	
	/**
	 * @param array $files
	 */
	public function setFiles(array $files) //: void
	{
		$this->files = $files;
	}
	
	/**
	 * @return bool
	 */
	public function isFeatured() //: bool
	{
		return $this->isFeatured;
	}
	
	/**
	 * @param bool $isFeatured
	 */
	public function setIsFeatured(bool $isFeatured)
	{
		$this->isFeatured = $isFeatured;
	}
	
	/**
	 * @return string
	 */
	public function getDescriptionShort() //: string
	{
		return $this->descriptionShort;
	}
	
	/**
	 * @param string $descriptionShort
	 */
	public function setDescriptionShort(string $descriptionShort)
	{
		$this->descriptionShort = $descriptionShort;
	}
	
	/**
	 * @return string
	 */
	public function getDescriptionLong() //: string
	{
		return $this->descriptionLong;
	}
	
	/**
	 * @param string $descriptionLong
	 */
	public function setDescriptionLong(string $descriptionLong)
	{
		$this->descriptionLong = $descriptionLong;
	}
	
	/**
	 * @return Brand
	 */
	public function getBrand()//: Brand
	{
		return $this->brand;
	}
	
	/**
	 * Set brand
	 *
	 * @param \Bundle\ProductBundle\Entity\Brand $brand
	 *
	 * @return Brand
	 */
	public function setBrand(\Bundle\ProductBundle\Entity\Brand $brand = null)
	{
		$this->brand = $brand;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getModel() //: string
	{
		return $this->model;
	}
	
	/**
	 * @param string $model
	 */
	public function setModel(string $model)
	{
		$this->model = $model;
	}
	
	
}

