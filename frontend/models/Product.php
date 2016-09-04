<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $detailes
 * @property string $image_url
 * @property string $price
 * @property string $Ingredients
 * @property string $created
 * @property string $updated
 * @property integer $category_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    /**
     * @var UploadedFile
     */

    public $imageFile ;

    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['detailes', 'Ingredients'], 'string'],
            [['created', 'updated'], 'safe'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['price'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
            'image_url' => 'Image Url',
            'detailes' => 'Detailes',
            'price' => 'Price',
            'Ingredients' => 'Ingredients',
            'created' => 'Created',
            'updated' => 'Updated',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {

        /* @var Product image_url   */
        if ($this->validate()) {
            if(!file_exists('uploadImage'))
            mkdir('uploadImage',0777);
            $this->imageFile->saveAs('uploadImage/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
