<?php

namespace AppBundle\Services\Transformers;

abstract class AbstractTransformer implements TransformerInterface {

	/**
	 * Transforms a collection of Objects
	 *
	 * @param array $items
	 *
	 * @return array
	 */
	public function transformCollection( array $items ) {
		return array_map( [ $this, 'transform' ], $items );
	}
}