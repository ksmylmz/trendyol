## Ürün işlemleri 
_________________


### 1- Init Object for Usage

````php
   use ksmylmz\trendyol\Trendyol;
    ......
    $isTeststage = true;
    $trendyol  = new Trendyol({username},{password},{merchantid},$isTestStage);
````

### 2- Ürün Yaratma

`````php
$product = new TrendyolProductModel();
$product->barcode= "Testbarkod-Deneme";
$product->title= "Bebek Takımı Pamuk";
$product->productMainId= "1234BT";
$product->brandId= 1791;
$product->categoryId= 411;
$product->quantity= 100;
$product->stockCode= "STK-345";
$product->dimensionalWeight= 2;
$product->description= "Ürün açıklama bilgisi";
$product->currencyType= "TRY";
$product->listPrice= 250.99;
$product->salePrice= 120.99;
$product->vatRate= 18;
$product->cargoCompanyId= 10;
$product->images = [
        new Image("https://www.sampleadress/path/folder/image_1.jpg"),
];
$product->attributes = [
    new Attribute([
        'attributeId'=>338,
        'attributeValueId'=>6980
    ]),
    new Attribute([
        'attributeId'=>338,
        'customAttributeValue'=>'PUDRA'                    
        ])
];

$request = new CreateUpdateRequestProductModel();
$request->items = [
    $product
];
//
$trendyol  = Yii::$app->trendyol;
$isupdate  = false; /// Burası true olduğunda create değil update isteği göndermiş oluyoruz        
$response  = $trendyol->product->productTransfer($request,$isupdate);
echo $response->response["batchRequestId"];
var_dump($response);

`````


### 3- Ürün Güncelleme 
Ürün Güncelleme işlemi için $isupdate değişlenini
`true` göndermek yeterlidir


### 4- Ürün yaratılma işlemi tamlanmış mı kontrolü
* `v2/createProducts, updatePriceAndInventory methodları servise yapılan istekler kuyruğa atarak işlendiği için, servise yapılan her başarlı istek sonucunda bir adet batchRequestId bilgisi dönülmektedir. Bu method yardımıyla batchRequestId ile alınan işlemlerin sonucunun kontrolü yapılabilir. Servis dönüşündeki "status" alanı kontrol edilerek toplu işlemin tamamlanıp tamamlanmadığı kontrol edilebilir. Eğer toplu işlem sonucunda bir ya da birden fazla item için hata oluşmuş ise failureReasons alanı kontrol edilerek sebebi bulunabilir.`*

````php
$response = $trendyol->product->checkBatchRequest("123456789");
echo $response->response["batchRequestId"];
var_dump($response);
`````


### 5-Tüm Kategorilerin Listesi

````php
$response = $trendyol->product->listTrendyolCategories();  
print_r($response->response["categories"]);          
var_dump($response);
 ````

 ### 6- Ürün Attrubute Kodları Listesi
 ````php
$response = $trendyol->product->listTrendyolAttributes(123455);
var_dump($response);
 ````
 ### 7- Tüm Taşıyıcı Firmaların Listesi 
 ````php
$response = $trendyol->product->listProviders();
var_dump($response);
 ````

### 8 Markaları Listeleme

````php
$response = $trendyol->product->listTrendyolBrands(123455);
print_r($response->response["brands"]);
var_dump($response);
````



 ### 9-İade ve Teslimat Adresleri Listesi
 ````php
$trendyol->product->getAddressesList();
//get-addresses-list
$response =  $trendyol->product->getAddressesList();
var_dump($response);
 ````
### 10- Stok ve Fiyat Güncelleme

 ````php
$listOfStockAndPriceItems=[
    new StockAndPriceUpdateRequestModel("8680000000",100,112.85,113),
    new StockAndPriceUpdateRequestModel("8680000001",10,112.85,113),
]; 
$result  = $trendyol->product->updateStockAndPriceTransfer($listOfStockAndPriceItems);
//update-stock-and-price
print_r($result->response["batchRequestId"]);
var_dump($result);
````