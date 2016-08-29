<?php
namespace AppBundle\Tests\Entities;


use AppBundle\Entities\Product;

class ProductTest extends \PHPUnit_Framework_TestCase {

	public function testConstructor() {
		$product = new Product( [
			'title'       => 'A title',
			'size'        => 75,
			'unitPrice'   => 75.5,
			'description' => 'A description',
		] );

		$this->assertEquals( 'A title', $product->getTitle() );
		$this->assertEquals( 75, $product->getSize() );
		$this->assertEquals( 75.5, $product->getUnitPrice() );
		$this->assertEquals( 'A description', $product->getDescription() );
	}

	public function testTitleSetsString() {
		$product = new Product();

		$product->setTitle( 'A title' );
		$this->assertEquals( 'A title', $product->getTitle() );
	}

	/**
	 * @expectedException AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testTitleTypeException() {
		$product = new Product();

		$product->setTitle( 1 );
	}

	public function testSizeSetsNumeric() {
		$product = new Product();

		$product->setSize( 75 );
		$this->assertEquals( 75, $product->getSize() );

		$product->setSize( 75.5 );
		$this->assertEquals( 75.5, $product->getSize() );

		// Not sure I want this to pass?
		$product->setSize( "75.5" );
		$this->assertEquals( "75.5", $product->getSize() );
	}

	/**
	 * @expectedException AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testSizeTypeException() {
		$product = new Product();

		$product->setSize( 'A string' );
	}

	public function testUnitPriceSetsNumeric() {
		$product = new Product();

		$product->setUnitPrice( 75 );
		$this->assertEquals( 75, $product->getUnitPrice() );

		$product->setUnitPrice( 75.5 );
		$this->assertEquals( 75.5, $product->getUnitPrice() );

		// Not sure I want this to pass?
		$product->setUnitPrice( "75.5" );
		$this->assertEquals( "75.5", $product->getUnitPrice() );
	}

	/**
	 * @expectedException AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testUnitPriceTypeException() {
		$product = new Product();

		$product->setUnitPrice( 'A string' );
	}

	public function testDescriptionSetsString() {
		$product = new Product();

		$product->setDescription( 'A description' );
		$this->assertEquals( 'A description', $product->getDescription() );
	}

	/**
	 * @expectedException AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testDescriptionTypeException() {
		$product = new Product();

		$product->setDescription( 1 );
	}
}