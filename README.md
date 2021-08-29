Trendyol Servis Modülü
======================


Trendyol WEb Servisi ile iletişim katmanı özelliği olan bu 
servis hazırlanırken [Trendyol Resmi dökümanyasyon](https://developers.trendyol.com/tr)unndan faydalanılmıştır

request işlemleri için Guzzle Kullanılmıştır. 
psr-4 standartlarına uyan her hangi bir yapı ile birlikte 
kullanılabilir. 

## Kurulum 
________


### 1- 
````
    composer require ksmylmz/trendyol
````


### 2- Örnek Kullanım

````php
   use ksmylmz\trendyol\Trendyol;
    ......
    $isTeststage = true;
    $trendyol  = new Trendyol({username},{password},{merchantid},$isTestStage);
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

