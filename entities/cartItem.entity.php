<?php
	class CartItem {
		private $id;
		private $itemID;
		private $count; 

		public function __construct($itemID, $count, $id = null){
			$this->itemID = $itemID;
			$this->id = $id;
			$this->count = $count;
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
	     * Gets the value of count.
	     *
	     * @return mixed
	     */
	    public function getCount()
	    {
	        return $this->count;
	    }

	    /**
	     * Sets the value of count.
	     *
	     * @param mixed $count the count
	     */
	    public function setCount($count)
	    {
	        $this->count = $count;
	    }

		/**
		 * Gets the value of itemID.
		 *
		 * @return mixed
		 */
		public function getItemID()
		{
		    return $this->itemID;
		}

		/**
		 * Sets the value of itemID.
		 *
		 * @param mixed $itemID the itemID
		 */
		public function setItemID($itemID)
		{
		    $this->itemID = $itemID;
		}
	}
?>