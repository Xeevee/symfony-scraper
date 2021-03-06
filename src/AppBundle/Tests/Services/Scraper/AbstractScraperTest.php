<?php

namespace AppBundle\Tests\Services\Scraper;

use AppBundle\Services\Scrapers\Product\Scraper;

class ScraperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Ensure a UnexpectedTypeException if setDocument doesn't receive a string
	 *
	 * TODO: Expand this out to other types
	 *
	 * @expectedException AppBundle\Services\Exceptions\UnexpectedTypeException
	 */
	public function testSetDocument() {
		$scraper = new Scraper();
		$scraper->setDocument( 1 );
	}

	/**
	 * Ensure a UnexpectedTypeException if setResource doesn't receive a string
	 *
	 * TODO: Expand this out to other types
	 *
	 * @expectedException AppBundle\Services\Exceptions\UnexpectedTypeException
	 */
	public function testSetResource() {
		$scraper = new Scraper();
		$scraper->setResource( 1 );
	}

	/**
	 * Ensure the expected document is returned
	 */
	public function testGetDocument() {
		$scraper = new Scraper();
		$scraper->setDocument( 'document' );
		$this->assertEquals( 'document', $scraper->getDocument() );
	}

	/**
	 * Ensure the expected resource is returned
	 */
	public function testGetResource() {
		$scraper = new Scraper();
		$scraper->setResource( 'resource' );
		$this->assertEquals( 'resource', $scraper->getResource() );
	}
}