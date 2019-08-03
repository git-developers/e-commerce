<?php
	
declare(strict_types=1);

namespace Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Brand
 *
 */
class Brand
{
    /**
     * @var integer
     *
     * @JMSS\Groups({"crud"})
     */
    private $id;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 * })
	 */
	private $code;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "frontend"
     * })
     */
    private $name;
	
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
     * @var \DateTime
     *
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     */
    private $isActive = true;
	
	public function __toString() {
		return sprintf('(%s) %s', $this->id, $this->name);
	}

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
	 * @return string
	 */
	public function getCode() //: string
	{
		return $this->code;
	}
	
	/**
	 * @param string $code
	 */
	public function setCode(string $code)
	{
		$this->code = $code;
	}
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Brand
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Brand
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Brand
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Brand
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
}
