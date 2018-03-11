<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/03/2018
 * Time: 7:55 PM
 */

namespace Stock\Contracts\Scrapers;


use GuzzleHttp\Client;

abstract class MarketContract implements ScraperContract
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
    protected $markets;

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
     * @return void
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
            }
        }

    }
}