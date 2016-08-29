<?php

namespace AppBundle\Entities;

class Product {

	/**
	 * The product title
	 *
	 * @var string
	 */
	private $title;

	/**
	 * The products page size
	 *
	 * @var mixed
	 */
	private $size;

	/**
	 * The products price per unit
	 *
	 * @var mixed
	 */
	private $unitPrice;

	/**
	 * The products description
	 *
	 * @var string
	 */
	private $description;

	/**
	 * Product constructor.
	 *
	 * Will attempt to populate the properties from an associative array on construction
	 *
	 * @param array $data
	 */
	public function __construct( array $data = [ ] ) {
		if ( isset( $data['title'] ) ) {
			$this->setTitle( $data['title'] );
		}

		if ( isset( $data['size'] ) ) {
			$this->setSize( $data['size'] );
		}

		if ( isset( $data['unitPrice'] ) ) {
			$this->setUnitPrice( $data['unitPrice'] );
		}

		if ( isset( $data['description'] ) ) {
			$this->setDescription( $data['description'] );
		}
	}

	/**
	 * Get the product's title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set the title
	 *
	 * @param string $title
	 *
	 * @return $this
	 */
	public function setTitle( $title ) {
		if ( is_string( $title ) ) {
			$this->title = $title;
		}

		return $this;
	}

	/**
	 * Get the product's title
	 *
	 * Will always be numeric
	 *
	 * @return mixed
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Set the size
	 *
	 * Should be represented in bytes, and must evaluate as numeric
	 *
	 * @param mixed $size
	 *
	 * @return $this
	 */
	public function setSize( $size ) {
		if ( is_numeric( $size ) ) {
			$this->size = $size;
		}

		return $this;
	}

	/**
	 * Get the product's unit price
	 *
	 * Will always be numeric
	 *
	 * @return mixed
	 */
	public function getUnitPrice() {
		return $this->unitPrice;
	}

	/**
	 * Set the unit price
	 *
	 * Must be numeric
	 *
	 * @param mixed $unitPrice
	 *
	 * @return $this
	 */
	public function setUnitPrice( $unitPrice ) {
		if ( is_numeric( $unitPrice ) ) {
			$this->unitPrice = $unitPrice;
		}

		return $this;
	}

	/**
	 * Get the product's description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set the description
	 *
	 * @param string $description
	 *
	 * @return $this
	 */
	public function setDescription( $description ) {
		if ( is_string( $description ) ) {
			$this->description = $description;
		}

		return $this;
	}

}