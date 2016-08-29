<?php

namespace AppBundle\Services\Transformers\ProductCollection;

use AppBundle\Entities\ProductCollection;

interface TransformerInterface extends \AppBundle\Services\Transformers\TransformerInterface {

	/**
	 * Transform a sing ProductCollection
	 *
	 * @param ProductCollection $ProductCollection
	 *
	 * @return mixed
	 */
	public function transform( ProductCollection $ProductCollection );
}