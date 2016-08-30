<?php

namespace AppBundle\Services\Scrapers\Products;


interface ScraperInterface extends \AppBundle\Services\Scrapers\ScraperInterface {

	/**
	 * Get the product title
	 *
	 * @return mixed
	 */
	public function getProductUrls();
}