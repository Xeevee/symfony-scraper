<?php

namespace AppBundle\Command;

use AppBundle\Entities\Product;
use AppBundle\Entities\ProductCollection;
use AppBundle\Services\Scrapers\Product\Scraper;
use AppBundle\Services\Scrapers\Products\ScraperInterface;
use AppBundle\Services\Transformers\ProductCollection\TransformerInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppRunCommand extends ContainerAwareCommand {

	/**
	 * Product scraper
	 *
	 * Scrapes the the data from the specified URL
	 *
	 * @var ScraperInterface
	 */
	private $scraper;

	/**
	 * Product transformer
	 *
	 * Converts the the passed Entity(s) into the appropriate JSON format
	 *
	 * @var TransformerInterface
	 */
	private $transformer;

	/**
	 * The resource to scrape
	 *
	 * Could be made a command argument, but feel it's unnecessary due to the specific nature of scraping
	 * @var string
	 */
	private $resource = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';

	/**
	 * AppRunCommand constructor.
	 *
	 * @param null|string $name
	 * @param ScraperInterface $scraper
	 * @param TransformerInterface $transformer
	 */
	public function __construct( $name, ScraperInterface $scraper, TransformerInterface $transformer ) {
		$this->scraper     = $scraper;
		$this->transformer = $transformer;
		parent::__construct( $name );
	}

	/**
	 * Configure the command
	 */
	protected function configure() {
		$this
			->setName( 'app:run' )
			->setDescription( 'Runs the application, return a json representation of the scraped product data.' );
	}

	/**
	 * Executes the application
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return void
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {

		try {
			$productCollection = $this->buildProductCollectionEntity( $this->getProductUrls() );
			$json              = $this->transformer->transform( $productCollection );

			$output->writeln( $json );
		} catch ( Exception $e ) {
			$output->writeln( "There was an unexpected error running the application: {$e->getMessage()}" );
		}

	}

	/**
	 * Get a response object
	 *
	 * @param string $url
	 *
	 * @return ResponseInterface
	 */
	private function getResponse( $url ) {
		$client   = new Client();
		$response = $client->get( $url );

		return $response;
	}

	/**
	 * Gets the individual product URL's
	 *
	 * @return mixed
	 */
	private function getProductUrls() {
		$client   = new Client();
		$response = $client->get( $this->resource );

		$this->scraper->setDocument( $response->getBody()->getContents() );
		$this->scraper->setResource( $this->resource );

		return $this->scraper->getProductUrls();
	}

	/**
	 * Builds the product entity from a response object
	 *
	 * @param ResponseInterface $response
	 *
	 * @return Product
	 */
	private function buildProductEntity( ResponseInterface $response ) {
		$scraper = new Scraper( $response->getBody()->getContents() );
		$product = new Product();

		$product->setTitle( $scraper->getTitle() );
		$product->setUnitPrice( $scraper->getUnitPrice() );
		$product->setDescription( $scraper->getDescription() );
		$product->setSize( $response->getHeader( 'Content-Length' ) );

		return $product;
	}

	/**
	 * Builds the product collection
	 *
	 * @param array $urls
	 *
	 * @return ProductCollection
	 */
	private function buildProductCollectionEntity( array $urls ) {
		$productCollection = new ProductCollection();

		foreach ( $urls as $url ) {
			$productCollection->add(
				$this->buildProductEntity(
					$this->getResponse( $url )
				)
			);
		}

		return $productCollection;
	}

}
