<?php

namespace AppBundle\Services\Transformers;

interface TransformerInterface {

	/**
	 * Transforms an array of objects
	 *
	 * @param array $items
	 *
	 * @return mixed
	 */
	public function transformCollection( array $items );
}