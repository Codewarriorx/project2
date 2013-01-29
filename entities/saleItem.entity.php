<?php
	class SaleItem {
		private $id;
		private $itemID;

		public function __construct($id = null){
			$this->id = $id;
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