<?php

namespace AppBundle\Services\Transformers\ProductCollection;

use AppBundle\Entities\ProductCollection;
use AppBundle\Services\Transformers\AbstractTransformer;
use AppBundle\Services\Transformers\Product\TransformerInterface as ProductTransformerInterface;

class Transformer extends AbstractTransformer implements TransformerInterface {

	/**
	 * The product transformer
	 *
	 * @var ProductTransformerInterface
	 */
	private $productTransformer;

	/**
	 * Transformer constructor.
	 *
	 * @param ProductTransformerInterface $productTransformer
	 */
	public function __construct( ProductTransformerInterface $productTransformer ) {
		$this->productTransformer = $productTransformer;
	}

	/**
	 * Transforms a ProductCollection into a JSON representation
	 *
	 * @param ProductCollection $collection
	 *
	 * @return string
	 */
	public function transform( ProductCollection $collection ) {
		return json_encode( [
			'results' => $this->getResults( $collection ),
			'total'   => $this->getTotal( $collection )
		] );
	}

	/**
	 * Get the transformed results
	 *
	 * The ProductTransformer returns a JSON string per product, this reverts it back to an array representation before
	 * returning it to avoid transform() encoding the JSON into a string
	 *
	 * @param ProductCollection $collection
	 *
	 * @return array
	 */
	protected function getResults( ProductCollection $collection ) {
		return array_map( 'json_decode', $this->productTransformer->transformCollection( $collection->getProducts() ) );
	}

	/**
	 * Get the transformed total
	 *
	 * @param ProductCollection $collection
	 *
	 * @return string
	 */
	protected function getTotal( ProductCollection $collection ) {
		return number_format( $collection->getTotal(), 2 );
	}
}