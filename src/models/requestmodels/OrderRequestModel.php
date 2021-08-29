<?php
namespace ksmylmz\trendyol\models\requestmodels;

use yii\base\Model;

class OrderRequestModel extends Model
{    

    /**
     * startDate
     *
     * @var int time türünden balangıç tarihi
     */
    public $startDate;     
    /**
     * endDate
     *
     * @var int time türünde bitiş tarihi
     */
    public $endDate;     
    /**
     * page
     *
     * @var int belirtilen sayfadaki kayıtları getir
     */
    public $page;     
    /**
     * size
     *
     * @var int sayfa başı kayıt adedi
     */
    public $size;     
    /**
     * orderNumber
     *
     * @var string belirli bir sipariş'in kaydını getirmek için kullanılır
     */
    public $orderNumber;     
    
    /**
     * orderByDirection
     *
     * @var string
     */
    public $orderByDirection;
       
    public function rules()
    {
        /**
         * TODO: tarih formatının validasyon messajı ile ilgili kısım eksik kaldı.
         * buna sonra tekrar döneceğiz
         */
        return [
            [['startDate','endDate','page','size'], 'number', 'message' => 'yanlis tarih formati | time türünde gönderilmelidir'],
        ];    
    }
}
