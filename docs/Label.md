# Muhasebe işlemleri 
_____________________


- Burada tanımlı etiket alma işlemleri kargolamayı Trendyol üzerinden  yapılacağı operasyonel süreç için geçerlidir. 

- `!önemli Barkod talebini ilgili sipariş paketine picking veya invoiced statüsü besledikten sonra yapmanız tavsiye edilmektedir.`

- Etiket alma isteği önce trendyol'a gönderilecek, Trendyol ilgili firmalara etiket isteğinde bulunacak sonrasında trendyol'a etiket getirme isteğinde bulunulabilecektir. 
- Etiket yaratma ve etiket getirme isteği arasında min 15 dk bulunmalır.
- Etiket işlemleri ZPL formatı ile yapılmaktadır. Alınan dosyanın kaydetme işlemi de aynı formatta yapılması gerekmektedir. 

### 1- Init Object for Usage

````php
   use ksmylmz\trendyol\Trendyol;
    ......
    $isTeststage = true;
    $trendyol  = new Trendyol({username},{password},{merchantid},$isTestStage);
````


### 2- Trendyol Common Etiket oluşturma 
````php
$trackingNo =  "1Z3X9A776803647522"; // uniq bir id örneğin sipariş no  olabilir
$boxQuantitiy = 0; //veirlmezse 1 kabul edilir
//create-label
$result = $trendyol->label->createLabel($trackingNo,$boxQuantitiy);
var_dump($result);
````
`Birden fazla koli ama tek gönderi olan gönderimlerde,
 her koli için bir etiket üretilmesi için BoxQuantitiy girilmelidir.`

### 3- Trendyol Common Etiket getirme 
````php
$result = $trendyol->label->getLabel("1Z3X9A776803647522");
var_dump($result);
````


> her iki işlem içinde test ortamında başarılı sonuç alınamadı 503 Service Unavailable hatası alındı
