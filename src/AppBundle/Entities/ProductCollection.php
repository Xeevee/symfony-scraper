<?php

namespace AppBundle\Entities;

use AppBundle\Entities\Exceptions\UnexpectedTypeException;

class ProductCollection {

	/**
	 * The products
	 *
	 * @var array
	 */
	private $products = [ ];

	/**
	 * The total unit price of the products
	 *
	 * @var mixed
	 */
	private $total;

	/**
	 * ProductCollection constructor.
	 *
	 * Will attempt to add products from an array on construction
	 *
	 * @param array $products
	 */
	public function __construct( array $products = [ ] ) {
		$this->addMultiple( $products );
	}

	/**
	 * Get the products
	 *
	 * @return array
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * Adds a single product
	 *
	 * Updates the total property
	 *
	 * @param Product $product
	 *
	 * @return $this
	 */
	public function add( Product $product ) {

		$this->products[] = $product;
		$this->total += $product->getUnitPrice();

		return $this;
	}

	/**
	 * Adds products from an array
	 *
	 * @param array $products
	 *
	 * @return $this
	 */
	public function addMultiple( array $products ) {
		foreach ( $products as $index => $product ) {
			if ( $product instanceof Product ) {
				$this->add( $product );
			} else {
				throw new UnexpectedTypeException( 'The $products parameter must be an array of AppBundle\Entities\Product, index "' . $index . '" is "' . gettype( $product ) . '"' );
			}
		}

		return $this;
	}

	/**
	 * Removes a product by key
	 *
	 * Updates the total property
	 *
	 * @param $key
	 *
	 * @return $this
	 */
	public function remove( $key ) {
		if ( isset( $this->products[ $key ] ) ) {
			$this->total -= $this->products[ $key ]->getUnitPrice();
			unset( $this->products[ $key ] );
		}

		return $this;
	}

	/**
	 * Clears the products
	 *
	 * Also resets the total to 0
	 *
	 * @return $this
	 */
	public function clear() {
		$this->total    = 0;
		$this->products = [ ];

		return $this;
	}

	/**
	 * Get the total
	 *
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}
}