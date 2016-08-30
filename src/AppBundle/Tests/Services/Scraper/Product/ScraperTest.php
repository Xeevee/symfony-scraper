<?php

namespace AppBundle\Tests\Services\Scraper\Product;

use AppBundle\Services\Scrapers\Product\Scraper;

class ScraperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Sample document HTML
	 *
	 * @var string
	 */
	private $sampleDocument = '<div class="productTitleDescriptionContainer"><h1>Some title</h1><p class="pricePerUnit">£3.50<abbr title="per">/</abbr><abbr title="unit"><span class="pricePerUnitUnit">unit</span></abbr></p><div id="information"><htmlcontent><div class="productText">A description</div></htmlcontent></div></div>';

	/**
	 * Ensure the expected title is returned
	 */
	public function testGetTitle() {
		$scraper = new Scraper( $this->sampleDocument );
		$this->assertEquals( 'Some title', $scraper->getTitle() );
	}

	/**
	 * Ensure an exception is thrown when querying a blank document
	 *
	 * TODO: Wrap InvalidArgumentException in a custom, more helpful Exception from the scraper oppose the Crawler
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testGetTitleNotFound() {
		$scraper = new Scraper( '' );
		$scraper->getTitle();
	}

	/**
	 * Ensure the expected unit price is returned
	 */
	public function testGetUnitPrice() {
		$scraper = new Scraper( $this->sampleDocument );
		$this->assertEquals( '3.50', $scraper->getUnitPrice() );
	}

	/**
	 * Ensure an exception is thrown when querying a blank document
	 *
	 * TODO: Wrap InvalidArgumentException in a custom, more helpful Exception from the scraper oppose the Crawler
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testGetUnitPriceNotFound() {
		$scraper = new Scraper( '' );
		$scraper->getUnitPrice();
	}

	/**
	 * Ensure the regex match only returns the expected format
	 */
	public function testGetUnitPriceRegExMatched() {
		$scraper = new Scraper( '<p class="pricePerUnit">Wrong format</p>' );
		$this->assertEquals( '', $scraper->getUnitPrice() );
	}

	/**
	 * Ensure the expected description is returned
	 */
	public function testGetDescription() {
		$scraper = new Scraper( $this->sampleDocument );
		$this->assertEquals( 'A description', $scraper->getDescription() );
	}

	/**
	 * Ensure an exception is thrown when querying a blank document
	 *
	 * TODO: Wrap InvalidArgumentException in a custom, more helpful Exception from the scraper oppose the Crawler
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testGetDescriptionNotFound() {
		$scraper = new Scraper( '' );
		$scraper->getDescription();
	}

}