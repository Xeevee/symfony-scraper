<?php

namespace AppBundle\Services\Scrapers;


interface ScraperInterface {

	/**
	 * ScraperInterface constructor.
	 *
	 * @param string $document
	 * @param string $resource
	 */
	public function __construct( $document = '', $resource = '' );

	/**
	 * Get the document
	 *
	 * @return string
	 */
	public function getDocument();

	/**
	 * Set the document
	 *
	 * @param $document
	 */
	public function setDocument( $document );

	/**
	 * Get the resource
	 *
	 * @return string
	 */
	public function getResource();

	/**
	 * Set the resource
	 *
	 * @param $resource
	 */
	public function setResource( $resource );
}