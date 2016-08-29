<?php

namespace AppBundle\Services\Transformers\Product;

use AppBundle\Entities\Product;
use AppBundle\Services\Transformers\AbstractTransformer;

class Transformer extends AbstractTransformer implements TransformerInterface {

	/**
	 * The multiplier for kilobytes
	 *
	 * @var int
	 */
	private $kiloBytesMultiplier = 1024;

	/**
	 * Transforms a Product into a JSON representation
	 *
	 * @param Product $product
	 *
	 * @return string
	 */
	public function transform( Product $product ) {
		return json_encode( [
			'title'       => $this->getTitle( $product ),
			'size'        => $this->getSize( $product ),
			'unit_price'  => $this->getUnitPrice( $product ),
			'description' => $this->getDescription( $product ),
		] );
	}

	/**
	 * Get the transformed title
	 *
	 * @param Product $product
	 *
	 * @return mixed
	 */
	protected function getTitle( Product $product ) {
		return $product->getTitle();
	}

	/**
	 * Get the transformed size
	 *
	 * @param Product $product
	 *
	 * @return string
	 */
	protected function getSize( Product $product ) {
		return number_format( $product->getSize() / $this->kiloBytesMultiplier, 1, '.', '' ) . 'kb';
	}

	/**
	 * Get the transformed title
	 *
	 * @param Product $product
	 *
	 * @return string
	 */
	protected function getUnitPrice( Product $product ) {
		return number_format( $product->getUnitPrice(), 2 );
	}

	/**
	 * Get the transformed description
	 *
	 * @param Product $product
	 *
	 * @return string
	 */
	protected function getDescription( Product $product ) {
		return trim( $product->getDescription() );
	}
}