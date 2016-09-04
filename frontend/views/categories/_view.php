<?php
/**
 * Created by PhpStorm.
 * User: shimi
 * Date: 14/02/16
 * Time: 23:58
 */
use frontend\models\Categories;
use yii\helpers\Html;

/* @var Categories $model */

?>
<div class="item  col-xs-4 col-lg-4">

    <a href="<?= \yii\helpers\Url::to(['product/by-category','id'=>$model->id])?>">
        view by category
    </a>
    <?= Html::a('edit',['update','id'=> $model->id])?>
    <div class="thumbnail">
        <img class="group list-group-image" src="<?= $model->image_url ?>" alt=""/>

        <div class="caption">
            <h4 class="group inner list-group-item-heading">
                <?= $model->name ?></h4>
        </div>
    </div>
</div>
