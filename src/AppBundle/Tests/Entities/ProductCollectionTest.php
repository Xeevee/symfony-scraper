<?php
namespace AppBundle\Tests\Entities;


use AppBundle\Entities\Product;
use AppBundle\Entities\ProductCollection;

class ProductCollectionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Ensure the constructor adds the products correctly
	 *
	 * @covers \AppBundle\Entities\ProductCollection::addMultiple
	 */
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
	 * Ensure an UnexpectedTypeException is a value passed to addMultiple isn't an instance of product
	 *
	 * @covers \AppBundle\Entities\ProductCollection::addMultiple
	 * @expectedException \AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testAddMultipleTypeException() {
		$productCollection = new ProductCollection();
		$products          = [
			'Not a product'
		];

		$productCollection->addMultiple( $products );
	}

	/**
	 * Ensure a product is added correctly and the total is modified accordingly
	 */
	public function testAdd() {
		$productCollection = new ProductCollection();
		$product           = new Product( [ 'unitPrice' => 10 ] );

		$productCollection->add( $product );
		$this->assertEquals( 10, $productCollection->getTotal() );
	}

	/**
	 * Ensure a product is removed correctly and the total is modified accordingly
	 */
	public function testRemove() {
		$productCollection = new ProductCollection();
		$product           = new Product( [ 'unitPrice' => 10 ] );

		$productCollection->add( $product );
		$productCollection->add( $product );
		$this->assertEquals( 20, $productCollection->getTotal() );

		$productCollection->remove( 0 );
		$this->assertEquals( 10, $productCollection->getTotal() );
	}

	/**
	 * Ensure a products are cleared and the total is modified accordingly
	 */
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