<?php

namespace AppBundle\Command;

use AppBundle\Services\Scrapers\ScraperInterface;
use AppBundle\Services\Transformers\ProductCollection\TransformerInterface;
use Exception;
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
			$products = $this->scraper->scrape();
			$json     = $this->transformer->transform( $products );

			$output->writeln( $json );

		} catch ( Exception $e ) {
			$output->writeln( "There was an unexpected error running the application: {$e->getMessage()}" );
		}

	}

}
