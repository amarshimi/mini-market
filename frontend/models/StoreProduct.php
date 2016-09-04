<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "store_product".
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $product_id
 * @property string $price
 */
class StoreProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'store_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
        ];
    }
}
