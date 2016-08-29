<?php

namespace AppBundle\Services\Scrapers\Product;


use AppBundle\Entities\Product;
use AppBundle\Entities\ProductCollection;
use GuzzleHttp\Client;
use AppBundle\Services\Scrapers\ScraperInterface;
use GuzzleHttp\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class Scraper implements ScraperInterface {

	/**
	 * The URl to scrape product data from
	 *
	 * @var string
	 */
	private $resource = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';

	/**
	 * The client used to request the URL(s)
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Scraper constructor.
	 *
	 * @param Client $client
	 */
	public function __construct( Client $client ) {
		$this->client = $client;
	}

	/**
	 * Runs the scraper
	 *
	 * Will follow and found products to their individual page to collect their detailed information
	 *
	 * @return ProductCollection
	 */
	public function scrape() {
		$products = new ProductCollection();
		$response = $this->client->get( $this->resource );
		$crawler  = new Crawler( $response->getBody()->getContents(), $this->resource );

		$crawler->filter( 'div.productInfo h3 a' )->each( function ( Crawler $node, $i ) use ( $products ) {
			$products->add( $this->scrapeProduct( $node->attr( 'href' ) ) );
		} );

		return $products;
	}

	/**
	 * @param $url
	 *
	 * Scrapes the data of an individual product page, and populates a Product entity
	 *
	 * TODO: Gets the page data & query's the result, possibly to many responsibilities?
	 *
	 * @return Product
	 */
	private function scrapeProduct( $url ) {
		$product  = new Product();
		$response = $this->client->get( $url );
		$crawler  = new Crawler( $response->getBody()->getContents(), $url );

		$product->setTitle( $this->getTitle( $crawler ) );
		$product->setSize( $this->getSize( $response ) );
		$product->setUnitPrice( $this->getUnitPrice( $crawler ) );
		$product->setDescription( $this->getDescription( $crawler ) );

		return $product;
	}

	/**
	 * Get the product title from the document
	 *
	 * @param Crawler $crawler
	 *
	 * @return string
	 */
	private function getTitle( Crawler $crawler ) {
		return $crawler->filter( 'div.productTitleDescriptionContainer h1' )->text();
	}

	/**
	 * Get the request size
	 *
	 * Using the Content-Length header
	 *
	 * @param ResponseInterface $response
	 *
	 * @return string
	 */
	private function getSize( ResponseInterface $response ) {
		return $response->getHeader( 'Content-Length' );
	}

	/**
	 * Get the products unit price
	 *
	 * Stripes unwanted formatting contained within the selector
	 *
	 * @param Crawler $crawler
	 *
	 * @return string
	 */
	private function getUnitPrice( Crawler $crawler ) {
		$text = $crawler->filter( 'p.pricePerUnit' )->text();
		preg_match( '([0-9]*\.[0-9]*)', $text, $matches );

		if ( ! empty( $matches[0] ) ) {
			return $matches[0];
		}

		return '';
	}

	/**
	 * Get the products description
	 *
	 * @param Crawler $crawler
	 *
	 * @return string
	 */
	private function getDescription( Crawler $crawler ) {
		return $crawler->filter( '#information htmlcontent div.productText' )->text();
	}
}