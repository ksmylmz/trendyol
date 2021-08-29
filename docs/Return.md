# İade işlemleri 
_________________


### 1- Init Object for Usage

````php
$trendyol  = Yii::$app->trendyol;
````

### 2- iade sebepleri listele
````php
$result =  $trendyol->return->getCliamReasons();
var_dump($result);
````



### 3- İade taleplerini listeleme

````php
$getClaimRequest  = new ClaimRequestModel();
$getClaimRequest->startDate=time();
$getClaimRequest->endDate=time();
$getClaimRequest->page=10;
$getClaimRequest->size=10;
$getClaimRequest->claimStatus=ClaimStatus::Created;

//get-claims
$result =$trendyol->return->getClaims($getClaimRequest);
var_dump($result->response);
````




### 4- İade talebi (Kodu) Oluşturma

*Deponuza iade kodu alınmadan gelen sipariş paketlerin iade talep paketlerini oluşturmak için kullanabilirsiniz. Bu servis ile paket oluşturduktan sonra iade paketlerini çekme servisi ile iade paketlerini tekrardan çekebilirsiniz.*

`````php
$claim  = new ClaimCreateRequestModel();
$claim->claimItems = [
    new ClaimItems([
        'reasonId' => "401", 
        'quantity' => 1,
        'barcode' => "456789",
        'customerNote' => "claim claim claim"
    ]),
    new ClaimItems([
        'reasonId' => "401", 
        'quantity' => 1,
        'barcode' => "456790",
        'customerNote' => "claim2 claim2 claim2"
    ]),

];
$claim->customerId=0;
$claim->excludeListing=true;
$claim->forcePackageCreation=true;
$claim->orderNumber="21654641";
$claim->shipmentCompanyId=10;

//create-claim
///postman collection daki payloadla da denendi ancak başarılı sonuç alınamadı
$result=$trendyol->return->createClaim($claim);
var_dump($result);
}
````



### 6- İade Taleplerini Kabul etme

`claimItemIdList :parametresinin bu şekilde olduğundan emin değilim trendyol dökümantasyonda açık bir şekilde yazmıyor bunu teyid etmek gerekecek`

````php
    $claim2BeApproved = new ClaimApproveRequestModel();
    $claim2BeApproved->claimLineItemIdList = [
        "967546455434"
    ];
    
    //approve-claim
    $result =  $trendyol->return->approveClaim("1700579203",$claim2BeApproved);
    var_dump($result);
````

### 7- iade taleplerini reddetme

````php
    $reject = new ClaimRejectionRequestModel();
    $reject->claimIssueReasonId = 418;
    $reject->claimItemIdList="f9da2317-876b-4b86-b8f7-0535c3b65731,f9da2317-876b-4b86-b8f7-0535c3b65732";
    $reject->description ="bla bla";
    
    //reject-claim
    $result =  $trendyol->return->rejectClaim("1700579203",$reject);
    var_dump($result);
````