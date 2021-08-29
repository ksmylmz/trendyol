Trendyol Servis Modülü
======================


Trendyol WEb Servisi ile iletişim katmanı özelliği olan bu 
servis hazırlanırken [Trendyol Resmi dökümanyasyon](https://developers.trendyol.com/tr)unndan faydalanılmıştır

Modül Yii2 frameworkü için component olarka hazırlanmışır. 
request işlemleri için Guzzle Kullanılmıştır. 

## Kurulum 
________


### 1- Component olarka ekleme 
````php
    'components' => [
        ......
        'trendyol' => [
            'class' => 'ksmylmz\trendyol\Trendyol',
            'username'=>"{$username}", //trendyol tarafından sağlanan kullanıcı adı
            'password'=>"{$password}",//trendyol tarafından sağlanan şifre
            'supplierId'=>"{$supplierID}" ////trendyol tarafından sağlanan supplier id 
            'isTestStage' => true, ///prod için false
        ]
        ......
    ],
````


### 2- Örnek Kullanım

````php
    $trendyol  = Yii::$app->trendyol;
    $response = $trendyol->product->productFilter(10,20);
    var_dump($response);
````

### 3-Dönen değeri değerlendirme (Handle)


` Request işlemlerinin sonucu ne olursa olsun aynı 
 obje ile dönülecektir. Dönüş nesnesinin status parametresine göre 
 request sonucu değerlendirilebilir. `
 
```php
 if($result->status)
 {

     var_dump($result->response)
 }
 {
     echo $result->statusCode; //Http response code
     echo $result->errorMessage; //String Error Mesage
     echo $result->errorCode ///Servisten dönen spesifik bir hata kodu varsa
  }
````


### 4- Kategorilerine göre işlemler 

#### A-[Ürün işlemleri](docs/Product.md)
#### B-[Spariş işlemleri](docs/Order.md)
#### C-[İade işlemleri](docs/Return.md)
#### D-[Muhasebe işlemleri](docs/Finance.md)
#### E-[Soru/Cevap işlemleri](docs/Questions.md)
#### E-[Etiket işlemleri](docs/Label.md)

