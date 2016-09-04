<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $type
 * @property integer $user_id
 * @property string $longitude
 * @property string $latitude
 * @property string $created
 * @property string $updated
 * @property string $shipping_days
 * @property string $hours
 * @property string $range
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'type', 'longitude', 'latitude', 'shipping_days', 'hours', 'range'], 'required'],
            [['type', 'user_id', 'range'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'address', 'shipping_days', 'hours'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'type' => 'Type',
            'user_id' => 'User ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'created' => 'Created',
            'updated' => 'Updated',
            'shipping_days' => 'Shipping Days',
            'hours' => 'Hours',
            'range' => 'Range',
        ];
    }
}
