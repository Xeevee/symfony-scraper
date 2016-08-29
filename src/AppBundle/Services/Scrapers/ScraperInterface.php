<?php

namespace AppBundle\Services\Scrapers;


interface ScraperInterface {

	/**
	 * Runs the scraper
	 *
	 * @return mixed
	 */
	public function scrape();
}