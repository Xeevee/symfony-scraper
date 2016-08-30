<?php
namespace AppBundle\Tests\Entities;


use AppBundle\Entities\Product;

class ProductTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Ensure the constructor populates the product correctly
	 */
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

	/**
	 * Ensure the the title is set correctly
	 */
	public function testTitleSetsString() {
		$product = new Product();

		$product->setTitle( 'A title' );
		$this->assertEquals( 'A title', $product->getTitle() );
	}

	/**
	 * Ensure an UnexpectedTypeException is a value passed to setTitle
	 *
	 * TODO: Build this out for other potential value types
	 *
	 * @expectedException \AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testTitleTypeException() {
		$product = new Product();

		$product->setTitle( 1 );
	}

	/**
	 * Ensure the the size is set correctly
	 */
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
	 * Ensure an UnexpectedTypeException is a value passed to setSize
	 *
	 * TODO: Build this out for other potential value types
	 *
	 * @expectedException \AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testSizeTypeException() {
		$product = new Product();

		$product->setSize( 'A string' );
	}

	/**
	 * Ensure the the unit price is set correctly
	 */
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
	 * Ensure an UnexpectedTypeException is a value passed to setUnitPrice
	 *
	 * TODO: Build this out for other potential value types
	 *
	 * @expectedException \AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testUnitPriceTypeException() {
		$product = new Product();

		$product->setUnitPrice( 'A string' );
	}

	/**
	 * Ensure the the description is set correctly
	 */
	public function testDescriptionSetsString() {
		$product = new Product();

		$product->setDescription( 'A description' );
		$this->assertEquals( 'A description', $product->getDescription() );
	}

	/**
	 * Ensure an UnexpectedTypeException is a value passed to setDescription
	 *
	 * TODO: Build this out for other potential value types
	 *
	 * @expectedException \AppBundle\Entities\Exceptions\UnexpectedTypeException
	 */
	public function testDescriptionTypeException() {
		$product = new Product();

		$product->setDescription( 1 );
	}
}