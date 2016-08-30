<?php

namespace AppBundle\Services\Scrapers;


use AppBundle\Services\Exceptions\UnexpectedTypeException;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractScraper implements ScraperInterface {

	/**
	 * The document content
	 *
	 * @var string
	 */
	protected $document = '';

	/**
	 * The resource being scraped
	 *
	 * @var string
	 */
	protected $resource = '';

	/**
	 * The DOM crawler
	 *
	 * @var Crawler
	 */
	protected $crawler ;

	/**
	 * Scraper constructor.
	 *
	 * @param $document
	 * @param $resource
	 */
	public function __construct( $document = '', $resource = '' ) {
		$this->setDocument( $document );
		$this->setResource( $resource );
		$this->updateCrawler();
	}

	/**
	 * Get the document
	 *
	 * @return string
	 */
	public function getDocument() {
		return $this->document;
	}

	/**
	 * Set the document
	 *
	 * @param $document
	 */
	public function setDocument( $document ) {
		if ( ! is_string( $document ) ) {
			throw new UnexpectedTypeException( 'The $title parameter must be a string, "' . gettype( $document ) . '" received.' );
		} else {
			$this->document = $document;
			$this->updateCrawler();
		}
	}

	/**
	 * Get the resource
	 *
	 * @return string
	 */
	public function getResource() {
		return $this->resource;
	}

	/**
	 * Set the resource
	 *
	 * @param $resource
	 */
	public function setResource( $resource ) {
		if ( ! is_string( $resource ) ) {
			throw new UnexpectedTypeException( 'The $resource parameter must be a string, "' . gettype( $resource ) . '" received.' );
		} else {
			$this->resource = $resource;
			$this->updateCrawler();
		}
	}

	/**
	 * Updates the crawler instance
	 */
	private function updateCrawler() {
		$this->crawler = new Crawler( $this->document, $this->resource );
	}
}