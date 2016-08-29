<?php
namespace AppBundle\Tests\Entities;


use AppBundle\Entities\Product;
use AppBundle\Entities\ProductCollection;

class ProductCollectionTest extends \PHPUnit_Framework_TestCase {

	public function testConstructor() {
		$products          = [
			new Product( [
				'title'       => 'Product 1',
				'size'        => 75,
				'unitPrice'   => 75.5,
				'description' => 'A description',
			] ),
			new Product( [
				'title'       => 'Product 2',
				'size'        => 75,
				'unitPrice'   => 75.5,
				'description' => 'A description',
			] )
		];
		$productCollection = new ProductCollection( $products );

		$this->assertEquals( $products, $productCollection->getProducts() );
	}

	/**
	 * @expectedException AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testAddMultipleTypeException() {
		$productCollection = new ProductCollection();
		$products          = [
			'Not a product'
		];

		$productCollection->addMultiple( $products );
	}

	public function testAdd() {
		$productCollection = new ProductCollection();
		$product           = new Product( [ 'unitPrice' => 10 ] );

		$productCollection->add( $product );
		$this->assertEquals( 10, $productCollection->getTotal() );
	}

	public function testRemove() {
		$productCollection = new ProductCollection();
		$product           = new Product( [ 'unitPrice' => 10 ] );

		$productCollection->add( $product );
		$productCollection->add( $product );
		$this->assertEquals( 20, $productCollection->getTotal() );

		$productCollection->remove( 0 );
		$this->assertEquals( 10, $productCollection->getTotal() );
	}

	public function testClear() {
		$productCollection = new ProductCollection();
		$product           = new Product( [ 'unitPrice' => 10 ] );

		$productCollection->add( $product );
		$productCollection->add( $product );
		$this->assertEquals( 20, $productCollection->getTotal() );

		$productCollection->clear();
		$this->assertEquals( 0, $productCollection->getTotal() );
	}
}