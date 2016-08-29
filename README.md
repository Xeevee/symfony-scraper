[![Build Status](https://travis-ci.org/Xeevee/symfony-scraper.svg?branch=master)](https://travis-ci.org/Xeevee/symfony-scraper)
[![Build Status](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Xeevee/symfony-scraper/?branch=master)

# Product Scraper

## Installation

1. Navigation to your base installation path: `cd /path/to/projects`
2. Create a new directory for the application: `mkdir scraper`
3. Navigate to the new directory: `cd scraper`
4. Clone the repository via: `git clone https://github.com/Xeevee/symfony-scraper.git`
5. Run composer install: `composer install`

### System requirements

The scraper requires `php 5.4` or higher, and is built on top of `Symfony 2.8`. with the exception of the PHP 5.4 version bump, there are no specific requirements extending beyond theirs, which can be found here: http://symfony.com/doc/2.8/reference/requirements.html

## Running the application
Once the application is installed you can execute the scrape via the CLI: `php app/console app:run`

A JSON representation of the scraped products will be printed to the console output.

## Running tests
You can run the test suite via the CLI with the following command: `phpunit -c app/`

The test suite is built on top of PHPUnit 4.8, so you can refer to their documentation for more advanced usage: https://phpunit.de/manual/4.8/en/index.html
