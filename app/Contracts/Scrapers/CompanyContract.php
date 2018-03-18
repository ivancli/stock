<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/03/2018
 * Time: 7:55 PM
 */

namespace Stock\Contracts\Scrapers;


use GuzzleHttp\Client;
use Stock\Exceptions\Scrapers\UnableToDownloadMarketResourceException;

abstract class CompanyContract implements ScraperContract
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $type = 'csv';

    /**
     * @var array
     */
    protected $companies;

    /**
     * @var string
     */
    protected $content;

    /**
     * MarketContract constructor.
     * @param string $url
     * @param string $type
     */
    public function __construct(string $url, string $type = 'csv')
    {
        $this->url = $url;

        $this->type = $type;
    }

    /**
     * Fetch content from given resources
     * @return CompanyContract
     * @throws UnableToDownloadMarketResourceException
     */
    public function fetch()
    {
        if (is_null($this->url) || !filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('URL malformed.', 500);
        }

        $client = new Client();
        $response = $client->request('GET', $this->url);
        if ($response->getBody()->isReadable()) {
            if ($response->getStatusCode() == 200) {
                $content = $response->getBody()->getContents();
                $this->content = $content;
            } else {
                throw new UnableToDownloadMarketResourceException($this->url, null, $response->getStatusCode());
            }
        }
        return $this;
    }

    /**
     * @return CompanyContract
     */
    abstract public function extract();

    /**
     * Get content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get companies
     * @return array
     */
    public function getCompanies()
    {
        return $this->companies;
    }
}