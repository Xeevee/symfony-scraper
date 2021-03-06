<?php

namespace AppBundle\Tests\Services\Transformers\ProductCollection;

use AppBundle\Entities\Product;
use AppBundle\Entities\ProductCollection;
use AppBundle\Services\Transformers\ProductCollection\Transformer;

class TransformerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Sample product JSON
	 *
	 * @var string
	 */
	private $productJson = '{"title":"A title","size":"1.0kb","unit_price":"75.50","description":"A description"}';

	/**
	 * Sample product colleciton JSON
	 *
	 * @var string
	 */
	private $expectedJson = '{"results":[{"title":"A title","size":"1.0kb","unit_price":"75.50","description":"A description"},{"title":"A title","size":"1.0kb","unit_price":"75.50","description":"A description"}],"total":"151.00"}';

	/**
	 * Ensure a collection of products are transformed correctly
	 */
	public function testTransform() {

		$baseProduct = new Product( [
			'title'       => 'A title',
			'size'        => 1024,
			'unitPrice'   => 75.5,
			'description' => 'A description',
		] );

		$productTransformer = $this->getMockBuilder( '\AppBundle\Services\Transformers\Product\Transformer' )
		                           ->setMethods( [ 'transform' ] )
		                           ->getMock();

		$productTransformer->expects( $this->exactly( 2 ) )
		                   ->method( 'transform' )
		                   ->with( $this->equalTo( $baseProduct ) )
		                   ->will( $this->returnValue( $this->productJson ) );

		$transformer = new Transformer( $productTransformer );
		$collection  = new ProductCollection( [ $baseProduct, $baseProduct ] );

		$json = $transformer->transform( $collection );
		$this->assertJsonStringEqualsJsonString( $json, $this->expectedJson );
	}
}