<?php

namespace Stock\Exceptions\Scrapers;

use Exception;
use Throwable;

class UnableToDownloadMarketResourceException extends Exception
{
    public function __construct(string $resourceUrl, string $message = "", int $code = 0, Throwable $previous = null)
    {
        $message = "Market Resource URL {{$resourceUrl}} responded with status code {$code}";

        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        /*TODO create notification to report error to developers*/
    }
}
