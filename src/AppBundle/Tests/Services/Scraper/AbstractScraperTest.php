<?php

namespace AppBundle\Tests\Services\Scraper;

use AppBundle\Services\Scrapers\Product\Scraper;

class ScraperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException AppBundle\Services\Exceptions\UnexpectedTypeException
	 */
	public function testSetDocument() {
		$scraper = new Scraper();
		$scraper->setDocument( 1 );
	}

	/**
	 * @expectedException AppBundle\Services\Exceptions\UnexpectedTypeException
	 */
	public function testSetResource() {
		$scraper = new Scraper();
		$scraper->setDocument( 1 );
	}

	public function testGetDocument() {
		$scraper = new Scraper();
		$scraper->setDocument( 'document' );
		$this->assertEquals( 'document', $scraper->getDocument() );
	}

	public function testGetResource() {
		$scraper = new Scraper();
		$scraper->setResource( 'resource' );
		$this->assertEquals( 'resource', $scraper->getResource() );
	}
}