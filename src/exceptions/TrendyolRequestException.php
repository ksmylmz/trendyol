<?php
namespace ksmylmz\trendyol\models\requests\invoices;

use yii\helpers\Json;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class TrendyolRequestException extends RequestException
{
    private $_errorMessages=[];
    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Throwable $previous = null,
        array $handlerContext = []
    )
    {
        parent::__construct($message,$request,$response,$previous,$handlerContext);
        if($this->hasResponse())
        {
            $body =Json::decode($this->getResponse()->getBody());
            foreach ($body as $key => $errorLine) {
                $this->_errorMessages[]= $errorLine->message;
            }
        }       
    }
}