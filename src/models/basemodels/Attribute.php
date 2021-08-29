<?php
namespace ksmylmz\trendyol\models\basemodels;

use yii\base\Model;

class Attribute extends Model
{    
    /**
     * attributeId
     *
     * @var sting 
     */
    public $attributeId;    
    /**
     * attributeValueId
     *
     * @var string
     */    
    public $attributeValueId;
    /**
     * customAttributeValue
     *
     * @var string
     */
    public $customAttributeValue;
}