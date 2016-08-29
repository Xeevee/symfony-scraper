<?php

namespace AppBundle\Services\Transformers\Product;

use AppBundle\Entities\Product;

interface TransformerInterface extends \AppBundle\Services\Transformers\TransformerInterface {

	/**
	 * Transform a single Product
	 *
	 * @param Product $product
	 *
	 * @return mixed
	 */
	public function transform( Product $product );
}