# Muhasebe işlemleri 
_________________


### 1- Init Object for Usage

````php
$trendyol  = Yii::$app->trendyol;
````

### 2- Settlement bilgilerini getirme 
#### settlements (Satış, İade, İndirim, Kupon, Provizyon işlemlerinin detaylarını verir)

````php
    $settlementRequest = new SettlementRequestModel();
    $settlementRequest->startDate = time();
    $settlementRequest->endDate = time();
    $settlementRequest->page=1;
    $settlementRequest->size=20;
    $settlementRequest->transactionType=SettleMentTransactionType::Sale;
    //get-settlements
    $result = $trendyol->finance->getSettleMents($settlementRequest);
    var_dump($result);
````

`transactionType Settlements için parametresinin alabileceği değerler`
|transactionType|Açıklama|
|---------------|--------|
|Sale|	Siparişlere ait satış kayıtlarını verir|
|Return|	Siparişlere ait iade kayıtlarını verir|
|Discount|	Tedarikçi tarafından karşılanan indirim tutarını gösterir.|
|DiscountCancel|	Ürün iptal veya iade olduğunda atılan kayıttır. İndirim kaydının tersi olarak düşünülebilir|
|Coupon|	Tedarikçi tarafından karşılanan kupon tutarını gösterir.|
|CouponCancel|	Ürün iptal veya iade olduğunda atılan kayıttır. Kupon kaydının tersi olarak düşünülebilir|
|ProvisionPositive|	Gramaj farkından dolayı oluşan tutarlar Provizyon kaydı olarak atılır. Sipariş iptal veya iade olduğunda birbirinin tersi olarak kayıt atılır.|
|ProvisionNegative|	Gramaj farkından dolayı oluşan tutarlar Provizyon kaydı olarak atılır. Sipariş iptal veya iade olduğunda birbirinin tersi olarak kayıt atılır.|



### 3- otherfinancials bilgilerini getirme
Bu bilgiler için aynı methodu kullanacağız ama 
transactionType parametresini OtherTransactionalType enum'u ile set edeceğiz.

`transactionType Otherfinancials için parametresinin alabileceği değerler`

|transactionType|Açıklama|
|---------------|--------|
|CashAdvance|	Vadesi henüz gelmemiş hakedişler için erken ödeme alındığında atılan kayıttır.|
|WireTransfer|	Trendyol ile Tedarikçi arasında yapılan virman için atılan kayıttır.|
|IncomingTransfer|	Borçlu durumundaki tedarikçiden, Trendyola yapılan ödemeler için atılan kayıttır|
|ReturnInvoice|	Tedarikçiden Trendyola kesilen iade faturalarıdır. Bakiyeyi + olarak etkiler.|
|CommissionAgreementInvoice|	Tedarikçinin mahsuplaşma yapılacak alacağı olmadığı durumda, iade gelen ürünler için tedarikçiden alınan komisyon mutabakat faturasıdır.|
|PaymentOrder|	Vadesi gelen işlemlerden hesaplanarak tedarikçiye yapılan hakediş ödemesidir|
|DeductionInvoices|	Trendyol tarafından sağlanan hizmetler için tedarikçiye kesilen faturadır.|


> her iki işlem içinde test ortamında başarılı sonuç alınamadı 503 Service Unavailable hatası alındı