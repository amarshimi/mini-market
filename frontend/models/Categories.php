<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_url
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    /**
     * @var UploadedFile
     */

    public $imageFile;
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],

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
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {

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
