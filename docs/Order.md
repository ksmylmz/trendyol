# Sipariş işlemleri 
_________________


### 1- Init Object for Usage

````php
$trendyol  = Yii::$app->trendyol;
````

### 2- Sipariş Listesi 

````php

    $date = new \DateTime("2020-10-10");
    $getOrderRequest->startDate = $date->getTimestamp();
    $date->modify("+1 week");
    $getOrderRequest->endDate= $date->getTimestamp();
    $getOrderRequest->page=10;
    $getOrderRequest->size=10;
    $getOrderRequest->orderByDirection=DirectionType::DESC;
    //get-orders
    $response =$trendyol->order->getOrders($getOrderRequest);
    print_r($response->response["content"]);
    var_dump($response);
````


### 3 - Kargo Takip Numarasını Güncelleme

````php
$result = $trendyol->order->updateTrackingNumber(44505271,"1Z3X9A776803647522");
print_r($result->response);
var_dump($result);
````

### 4-Sipariş durumunu güncelleme
````php
$status = new PackageStatusUpdateRequestModel();
$status->lines = [
    new PackageLine(123456,1),
];
$status->params = new PackageParams("EME2018000025208");
$status->status = OrderStatus::Picking;
$result = $trendyol->order->updatePackageStatus(44505271,$status);
var_dump($result);

// /*Invoice bilgisi göndermek için  */
// $status->status = OrderStatus::Invoiced;
// $trendyol->order->updatePackageStatus(44505271,$status);

// /** Temin Edememe Bildirimi gönderme*/
// $status->status = OrderStatus::UnSupplied;
// $trendyol->order->updatePackageStatus(44505271,$status);
`````

### 5- Fatura bilgisi Güncelleme
````php
$invoiceLink = new SendInvoiceLinkRequestModel();
$invoiceLink->invoiceLink = "https://extfatura.faturaentegratoru.com/324523-34523-52345-3453245.pdf";
$invoiceLink->shipmentPackageId = 44505271;
    //send-invoice-link
    ///body yok sadece 201 dönüyor
$result = $trendyol->order->sendInvoiceLink($invoiceLink);
var_dump($result);
````


### 6- Sipariş Paketlerini Parçalama
`````php
//split-packages
$trendyol  = Yii::$app->trendyol;
$split = new OrderSplitRequestModel();
$split->splitPackages = [
    new SplitOrderDetails([
        new OrderLine(123456,1),
        new OrderLine(123456,2),
        new OrderLine(123456,3),
    ])
];
$shipmentPackageID = "44505271";
$result =$trendyol->order->splitOrderPackage($shipmentPackageID,$split);
var_dump($result->response);
``````

### 7 - Kargo firması güncelleme
````php
$shipmentPackageID = 44505271;
$result =$trendyol->order->changeCargoCompany($shipmentPackageID,CargoCompanies::YKMP);
///response body yok sadece 200 dönüyor
var_dump($result);
````
