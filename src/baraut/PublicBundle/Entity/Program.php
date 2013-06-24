<?php

namespace baraut\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Table(name="program")
* @ORM\Entity
* @ORM\HasLifecycleCallbacks 
*/
class Program
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/
	protected $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */

	private $name;

	/**
	 * @ORM\OneToMany(targetEntity="Shortcut", mappedBy="program")
	 */
	protected $shortcuts;

	/**
	 * @var datetime
	 * @ORM\Column(type="datetime")
	 */

	private $created;

	/**
	 * @var datetime 	
	 * @ORM\Column(type="datetime")
	 */

	private $modified;

	/**
	* @ORM\PrePersist
	*/
	public function doCreated()
	{ 
		$this->setCreated(new \DateTime("now"));
		$this->setModified(new \DateTime("now"));
	}

	/**
	* @ORM\PreUpdate
	*/
	public function doModified()
	{ 
		$this->setModified(new \DateTime("now"));
	}
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shortcuts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Program
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
     * Add shortcuts
     *
     * @param \baraut\PublicBundle\Entity\Shortcut $shortcuts
     * @return Program
     */
    public function addShortcut(\baraut\PublicBundle\Entity\Shortcut $shortcuts)
    {
        $this->shortcuts[] = $shortcuts;
    
        return $this;
    }

    /**
     * Remove shortcuts
     *
     * @param \baraut\PublicBundle\Entity\Shortcut $shortcuts
     */
    public function removeShortcut(\baraut\PublicBundle\Entity\Shortcut $shortcuts)
    {
        $this->shortcuts->removeElement($shortcuts);
    }

    /**
     * Get shortcuts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShortcuts()
    {
        return $this->shortcuts;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Program
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Program
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    public function __toString(){
    	return $this->name;
    }

}