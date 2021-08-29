<?php
/**
 * @author Kasım YILMAZ
 * @create date 2021-06-29 16:31:17
 * @modify date 2021-06-29 16:31:17
 * @desc Bu modül, Trendyol entegrasyon çalışmasının servis iletişim katmanıdır.
 * Temel Usage ile ilgili bilgiliyi  README.md 'dosyasında 
 * Ayrıntılı Usage dökümanları docs klasörünün altında bulabilirsiniz
 */
namespace ksmylmz\trendyol;

use ksmylmz\trendyol\config\Credentials;
class Trendyol 
{
    public $product;
    public $order;
    public $return;
    public $question;
    public $finance;
    public $label;
    public $username;
    public $password;
    public $supplierId;
    public $isTestStage;
    public function __construct($username,$password,$supplierId,$isTestStage=true)
    {    
        $credentials = new Credentials();
        $credentials->username=$username;
        $credentials->password=$password;
        $credentials->supplierId=$supplierId;
        $this->product  = new \ksmylmz\trendyol\service\ProductService($isTestStage,$credentials);
        $this->order  = new \ksmylmz\trendyol\service\OrderService($isTestStage,$credentials);
        $this->return  = new \ksmylmz\trendyol\service\ReturnService($isTestStage,$credentials);
        $this->question  = new \ksmylmz\trendyol\service\QuestionService($isTestStage,$credentials);
        $this->finance  = new \ksmylmz\trendyol\service\FinanceService($isTestStage,$credentials);
        $this->label = new \ksmylmz\trendyol\service\LabelService($isTestStage,$credentials);
    }

    
}
