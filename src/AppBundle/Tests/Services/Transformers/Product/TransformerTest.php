<?php

namespace AppBundle\Tests\Services\Transformers\Product;

use AppBundle\Entities\Product;
use AppBundle\Services\Transformers\Product\Transformer;

class TransformerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Sample response JSON
	 *
	 * @var string
	 */
	private $expectedJson = '{"title":"A title","size":"1.0kb","unit_price":"75.50","description":"A description"}';

	/**
	 * Ensure the product is transformed correctly
	 */
	public function testTransform() {

		$product = new Product( [
			'title'       => 'A title',
			'size'        => 1024,
			'unitPrice'   => 75.5,
			'description' => 'A description',
		] );

		$transformer = new Transformer();

		$json = $transformer->transform( $product );
		$this->assertJsonStringEqualsJsonString( $json, $this->expectedJson );
	}
}