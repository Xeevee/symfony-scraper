<?php

namespace AppBundle\Services\Scrapers\Product;


interface ScraperInterface extends \AppBundle\Services\Scrapers\ScraperInterface {

	/**
	 * Get the product title
	 *
	 * @return mixed
	 */
	public function getTitle();

	/**
	 * Get the product unit price
	 *
	 * @return mixed
	 */
	public function getUnitPrice();

	/**
	 * Get the product description
	 *
	 * @return mixed
	 */
	public function getDescription();
}