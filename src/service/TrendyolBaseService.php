<?php
namespace ksmylmz\trendyol\service;

use yii\helpers\Json;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Message;
use ksmylmz\trendyol\config\Endpoints;
use ksmylmz\trendyol\config\Credentials;
use GuzzleHttp\Exception\RequestException;

use ksmylmz\trendyol\models\basemodels\TrendyolBaseResponseModel;
use ksmylmz\trendyol\models\requests\invoices\TrendyolRequestException;

class TrendyolBaseService
{
    /**
     *  @var $client GuzzleHttp\Client 
     *  @var $request  GuzzleHttp\Psr7\Request 
     *  @param $isTestStage bool client object is test instance or prod instance 
     *  @param $endpoint string
     *   
     */
    protected $client;
    protected $isTestStage;
    protected Credentials $credentials;
    public function __construct($isTestStage=true,Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->isTestStage = $isTestStage;
        $base_url =$isTestStage ?  Endpoints::test_base_url : Endpoints::prod_base_url;
        $header = $this->getHeader($base_url);
        $this->client  = new Client($header);

    }
    
    
    /** 
     * generating url with supplier id
     * @return string
    */
    public function getUrl($endpoint)
    {
        return Endpoints::suppliers."/".$this->credentials->supplierId."/".$endpoint;
    }
    /** 
     * generating url without supplier id
     * @return string
    */
    public function getUrlWithoutSuppliers($endpoint)
    {
        return $endpoint;
    }
    public function geFinancetUrl($endpoint)
    {
        return Endpoints::financeSubDomain."/".$this->credentials->supplierId."/".$endpoint;
    }

    protected function getHeader($base_url)
    {
        return [
            'base_uri'=> $base_url,
            'headers'=>[
                "Authorization"=>'Basic '. base64_encode($this->credentials->username.":".$this->credentials->password),
                "User-Agent"=>$this->credentials->username." - "."SelfIntegration",
                "Content-Type" => "application/json",
                "Accept" => "application/json"
            ]
        ];
    }

    public function request($method, $uri = '', array $options = [])
    {
        $baseresponse = new TrendyolBaseResponseModel();
        $_response = null;
        try {
            $_response = $this->client->request($method, $uri, $options);
            $baseresponse->status=true;
            $baseresponse->statusCode=$_response->getStatusCode();
            $baseresponse->response=Json::decode($_response->getBody()->getContents());
        } catch (RequestException $e) 
        {
            $baseresponse->status=false;
            $baseresponse->statusCode=$e->getCode();
            $baseresponse->errorMessage= $e->getMessage();
            if($e->hasResponse())
            {
                $baseresponse->response =$e->getResponse()->getBody(); //Json::decode($e->getResponse()->getBody());
            }

        }finally
        {
            ///GuzzleHttp\Client
            $baseresponse->client=$this->client;
        }
        return $baseresponse;
    }

}