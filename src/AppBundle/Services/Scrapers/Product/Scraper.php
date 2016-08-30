<?php

namespace AppBundle\Services\Scrapers\Product;


use AppBundle\Services\Scrapers\AbstractScraper;

class Scraper extends AbstractScraper implements ScraperInterface {

	/**
	 * Get the product's title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->crawler->filter( 'div.productTitleDescriptionContainer h1' )->text();
	}

	/**
	 * Get the product's unit price
	 *
	 * Stripes unwanted formatting contained within the selector
	 *
	 * @return string
	 */
	public function getUnitPrice() {
		$text = $this->crawler->filter( 'p.pricePerUnit' )->text();

		if( preg_match( '([0-9]*\.[0-9]*)', $text, $matches ) )
		{
			return $matches[0];
		} else {
		}
	}

	/**
	 * Get the product's description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->crawler->filter( '#information htmlcontent div.productText' )->text();
	}
}