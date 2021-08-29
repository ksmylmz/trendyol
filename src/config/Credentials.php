<?php
namespace ksmylmz\trendyol\config;

use yii\base\Model;

class Credentials extends Model
{
    /**
     * Trendyol web servisine bağnatı için gerekli
     * credential bilgiler
     */    
    /**
     * username
     *
     * @var string
     */
    public $username;    
    /**
     * password
     *
     * @var string
     */
    public $password;    
    /**
     * supplierId
     *
     * @var string
     */
    public $supplierId;
}