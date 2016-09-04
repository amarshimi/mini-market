<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $store_id
 * @property string $orders_details
 * @property integer $payment_method
 * @property integer $sum
 * @property string $location
 * @property integer $receive
 * @property integer $status
 */
class Order extends \yii\db\ActiveRecord
{

    const STATUS_START = 1;
    const STATUS_END = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'store_id', 'payment_method', 'sum', 'receive'], 'integer'],
            [['orders_details'], 'string'],
            [['location'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'store_id' => 'Store ID',
            'orders_details' => 'Orders Details',
            'payment_method' => 'Payment Method',
            'sum' => 'Sum',
            'location' => 'Location',
            'receive' => 'Receive',
        ];
    }
}
