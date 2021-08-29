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

use yii\base\Component;
use ksmylmz\trendyol\config\Credentials;
class Trendyol extends Component
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
    function init()
    {    
        $credentials = new Credentials([
            'username'=>$this->username,
            'password'=>$this->password,
            'supplierId'=>$this->supplierId
        ]);
        $this->product  = new \ksmylmz\trendyol\service\ProductService($this->isTestStage,$credentials);
        $this->order  = new \ksmylmz\trendyol\service\OrderService($this->isTestStage,$credentials);
        $this->return  = new \ksmylmz\trendyol\service\ReturnService($this->isTestStage,$credentials);
        $this->question  = new \ksmylmz\trendyol\service\QuestionService($this->isTestStage,$credentials);
        $this->finance  = new \ksmylmz\trendyol\service\FinanceService($this->isTestStage,$credentials);
        $this->label = new \ksmylmz\trendyol\service\LabelService($this->isTestStage,$credentials);
    }

    
}
