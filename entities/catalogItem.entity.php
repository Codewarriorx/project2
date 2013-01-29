<?php
	class CatalogItem {
		private $id;
		private $name; 
		private $description;
		private $price;
		private $quantity;
		private $image;
		private $salePrice;

		public function __construct($name, $description, $price, $quantity, $image, $salePrice, $id = null){
			$this->id = $id;
			$this->name = $name;
			$this->description = $description;
			$this->price = $price;
			$this->quantity = $quantity;
			$this->image = $image;
			$this->salePrice = $salePrice;
		}
		
		public function toArray(){
			return get_object_vars($this);
		}

		/**
		 * Gets the value of id.
		 *
		 * @return mixed
		 */
		public function getID()
		{
		    return $this->id;
		}

		/**
		 * Sets the value of id.
		 *
		 * @param mixed $id the id
		 */
		public function setID($id)
		{
		    $this->id = $id;
		}

	    /**
	     * Gets the value of name.
	     *
	     * @return mixed
	     */
	    public function getName()
	    {
	        return $this->name;
	    }

	    /**
	     * Sets the value of name.
	     *
	     * @param mixed $name the name
	     */
	    public function setName($name)
	    {
	        $this->name = $name;
	    }

	    /**
	     * Gets the value of description.
	     *
	     * @return mixed
	     */
	    public function getDescription()
	    {
	        return $this->description;
	    }

	    /**
	     * Sets the value of description.
	     *
	     * @param mixed $description the description
	     */
	    public function setDescription($description)
	    {
	        $this->description = $description;
	    }

	    /**
	     * Gets the value of price.
	     *
	     * @return mixed
	     */
	    public function getPrice()
	    {
	        return $this->price;
	    }

	    /**
	     * Sets the value of price.
	     *
	     * @param mixed $price the price
	     */
	    public function setPrice($price)
	    {
	        $this->price = $price;
	    }

	    /**
	     * Gets the value of quantity.
	     *
	     * @return mixed
	     */
	    public function getQuantity()
	    {
	        return $this->quantity;
	    }

	    /**
	     * Sets the value of quantity.
	     *
	     * @param mixed $quantity the quantity
	     */
	    public function setQuantity($quantity)
	    {
	        $this->quantity = $quantity;
	    }

	    /**
	     * Gets the value of image.
	     *
	     * @return mixed
	     */
	    public function getImage()
	    {
	        return $this->image;
	    }

	    /**
	     * Sets the value of image.
	     *
	     * @param mixed $image the image
	     */
	    public function setImage($image)
	    {
	        $this->image = $image;
	    }

	    /**
	     * Gets the value of salePrice.
	     *
	     * @return mixed
	     */
	    public function getSaleprice()
	    {
	        return $this->salePrice;
	    }

	    /**
	     * Sets the value of salePrice.
	     *
	     * @param mixed $salePrice the salePrice
	     */
	    public function setSaleprice($salePrice)
	    {
	        $this->salePrice = $salePrice;
	    }
	}
?>