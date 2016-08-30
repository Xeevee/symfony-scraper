<?php

namespace AppBundle\Tests\Services\Scraper\Products;

use AppBundle\Services\Scrapers\Products\Scraper;

class ScraperTest extends \PHPUnit_Framework_TestCase {

	private $sampleDocument = '<div class="productInfo"><h3><a href="linkOne"></a></h3></div><div class="productInfo"><h3><a href="linkTwo"></a></h3></div><div class="productInfo"><h3><a href="linkThree"></a></h3></div>';

	public function testGetProductUrls() {
		$scraper = new Scraper($this->sampleDocument);
		$this->assertEquals(['linkOne', 'linkTwo', 'linkThree'], $scraper->getProductUrls());
	}

}