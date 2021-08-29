<?php
namespace ksmylmz\trendyol\models\requestmodels;

use ksmylmz\trendyol\models\basemodels\OrderStatus;
use ksmylmz\trendyol\models\basemodels\PackageParams;

class PackageStatusUpdateRequestModel
{    
    /**
     * lines
     *
     * @var array of LinePackage
     */
    public $lines;    
    /**
     * params
     *
     * @var array
     */
    public PackageParams $params;    
    /**
     * status
     *
     * @var OrderStatus
     */
    public $status;
}