<?php

namespace AppBundle\Tests\Services\Scraper\Product;

use AppBundle\Services\Scrapers\Product\Scraper;

class ScraperTest extends \PHPUnit_Framework_TestCase {

	private $sampleDocument = '<div class="productTitleDescriptionContainer"><h1>Some title</h1><p class="pricePerUnit">£3.50<abbr title="per">/</abbr><abbr title="unit"><span class="pricePerUnitUnit">unit</span></abbr></p><div id="information"><htmlcontent><div class="productText">A description</div></htmlcontent></div></div>';

	public function testGetTitle() {
		$scraper = new Scraper($this->sampleDocument);
		$this->assertEquals('Some title', $scraper->getTitle());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetTitleNotFound() {
		$scraper = new Scraper('');
		$scraper->getTitle();
	}

	public function testGetUnitPrice() {
		$scraper = new Scraper($this->sampleDocument);
		$this->assertEquals('3.50', $scraper->getUnitPrice());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetUnitPriceNotFound() {
		$scraper = new Scraper('');
		$scraper->getUnitPrice();
	}

	public function testGetDescription() {
		$scraper = new Scraper($this->sampleDocument);
		$this->assertEquals('A description', $scraper->getDescription());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetDescriptionNotFound() {
		$scraper = new Scraper('');
		$scraper->getDescription();
	}

}