<?php
namespace ksmylmz\trendyol\service;

use yii\helpers\Json;
use ksmylmz\trendyol\config\Endpoints;
use ksmylmz\trendyol\models\basemodels\OrderStatus;
use ksmylmz\trendyol\models\basemodels\DirectionType;
use ksmylmz\trendyol\models\requestmodels\OrderRequestModel;
use ksmylmz\trendyol\models\basemodels\TrendyolBaseResponseModel;
use ksmylmz\trendyol\models\requestmodels\OrderSplitRequestModel;
use ksmylmz\trendyol\models\requestmodels\SendInvoiceLinkRequestModel;
use ksmylmz\trendyol\models\requestmodels\PackageStatusUpdateRequestModel;
use ksmylmz\trendyol\models\requestmodels\UpdateCargoTrackingModel;

class OrderService extends TrendyolBaseService
{    
    /**
     * getOrders
     *
     * @param  OrderRequestModel $orderRequest
     * @return TrendyolBaseResponseModel
     */
    public function getOrders(OrderRequestModel $orderRequest)
    {
        try
        {               
            //if(!$orderRequest->validate()) throw new \Exception($orderRequest->errors);
            $querystringParameters=[];
            foreach ($orderRequest as $key => $value) 
            {
                if($value!=null)
                {
                    $querystringParameters[$key]=$value;
                } 
            }
            $queryString =  http_build_query($querystringParameters);
            $endpoint  = $this->getUrl(Endpoints::orders."?".$queryString);
            return $this->request("GET",$endpoint);

        } catch (\Throwable $th) 
        {
            $result = new TrendyolBaseResponseModel();
            $result->status=false;
            $result->errorMessage=$th->getMessage();
            return  $result;
        }
    }
    
    /**
     * updateTrackingNumber
     *
     * @param  int $shipmentPackageId
     * @param  string $trackingNo
     * @return TrendyolBaseResponseModel
     */
    public function updateTrackingNumber($shipmentPackageId,$trackingNo)
    {
        $endpoint = $this->getUrl(str_replace("@shipmentPackageId",$shipmentPackageId,Endpoints::updateShippingCode));
    
        $payload = ["body"=>Json::encode(new UpdateCargoTrackingModel(["trackingNumber"=>$trackingNo]))];
        return $this->request("PUT",$endpoint,$payload);
    }    
    /**
     * updatePackageStatus
     *
     * @param  mixed $shipmentPackageId
     * @param  mixed $packageStatusUpdateRequestModel
     * @return TrendyolBaseResponseModel
     */
    public function updatePackageStatus($shipmentPackageId, PackageStatusUpdateRequestModel $packageStatusUpdateRequestModel)
    {
        $endpoint = $this->getUrl(str_replace("@Id",$shipmentPackageId,Endpoints::updatePackageStatus));
        $payload = ["body"=>json_encode($packageStatusUpdateRequestModel)];
        return $this->request("PUT",$endpoint,$payload);
    }    
    /**
     * sendInvoiceLink
     *
     * @param  SendInvoiceLinkRequestModel $invoiceRequest
     * @return TrendyolBaseResponseModel
     */
    public function sendInvoiceLink(SendInvoiceLinkRequestModel $invoiceRequest)
    {
        $endpoint = $this->getUrl(Endpoints::sendInvoiceLinks);
        $payload = ["body"=>json_encode($invoiceRequest)];
        return $this->request("POST",$endpoint,$payload);
    }    
    /**
     * splitOrderPackage
     *
     * @param  string $shipmentPackageId
     * @param  OrderSplitRequestModel $invoiceRequest
     * @return TrendyolBaseResponseModel
     */
    public function splitOrderPackage($shipmentPackageId,OrderSplitRequestModel $invoiceRequest)
    {
        $endpoint = $this->getUrl(str_replace("@shipmentPackageId",$shipmentPackageId,Endpoints::splitPackages));
        $payload = ["body"=>json_encode($invoiceRequest)];
        return $this->request("POST",$endpoint,$payload);
    }    
    /**
     * changeCargoCompany
     *
     * @param  string $shipmentPackageId
     * @param  string $cargoCompany models\basemodels\CargoCompanies
     * türünde enum ile set edilebilir
     * @return TrendyolBaseResponseModel
     */
    public function changeCargoCompany($shipmentPackageId, $cargoCompany)
    {
        $endpoint = $this->getUrl(str_replace("@shipmentPackageId",$shipmentPackageId,Endpoints::changeCargoProviders));
        $payload = ["body"=>json_encode(["cargoProvider"=>$cargoCompany])];
        return $this->request("PUT",$endpoint,$payload);
    }
}