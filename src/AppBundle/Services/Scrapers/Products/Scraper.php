<?php

namespace AppBundle\Services\Scrapers\Products;


use AppBundle\Services\Scrapers\AbstractScraper;
use Symfony\Component\DomCrawler\Crawler;

class Scraper extends AbstractScraper implements ScraperInterface {

	/**
	 * Get the product URL's
	 *
	 * @return array
	 */
	public function getProductUrls() {
		$urls = $this->crawler->filter( 'div.productInfo h3 a' )->each( function ( Crawler $node, $i ) {
			return $node->attr( 'href' );
		} );

		return $urls;
	}
}